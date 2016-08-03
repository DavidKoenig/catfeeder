<?php
/**
 * Created by PhpStorm.
 * User: kinske
 * Date: 30.03.16
 * Time: 15:12
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Settings;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class FeedController extends Controller
{
    /**
     * @Route("/feed", name="feed")
     */
    public function feedAction(Request $request)
    {
        // There has to be only one setting.
        $settings = $this->getDoctrine()->getRepository('AppBundle:Settings')->findAll()[0];
        // Is the light-barrier on or off?
        exec("ps -ef | grep light-barrier.py | grep -v grep | awk '{print$2}'", $outputLightBarrier);
      	$lightBarrierActive = $outputLightBarrier ? true : false;

        // Forms
        $feedFormData = [];
        $feedForm = $this->get('form.factory')->createNamedBuilder('feed-form', FormType::class, $feedFormData, [
            'csrf_protection' => false,
	    'allow_extra_fields' => true
        ])
        ->add('hiddenField', TextType::class, array('required' => false))
        ->getForm();
        $feedForm->handleRequest($request);

        $barrierFormData = [];
        $barrierForm = $this->get('form.factory')->createNamedBuilder('barrier-form', FormType::class, $barrierFormData,
            array(
            'csrf_protection' => false,
	        'allow_extra_fields' => true
        ))
        ->add('hiddenField', TextType::class, array('required' => false))
        ->getForm();
        $barrierForm->handleRequest($request);

        // Form submissions
        if($barrierForm->isSubmitted()) {
                if ($lightBarrierActive === true) {
                    exec('sudo /var/www/html/cat-feeder/app/Resources/pi/catfeeder-sudo-script.sh false > /dev/null &');
                }
                else {
                    exec('sudo /var/www/html/cat-feeder/app/Resources/pi/catfeeder-sudo-script.sh true 11010 4 1 > /dev/null &');
                }
        }

        if ($feedForm->isSubmitted()) {
            $source = $_SERVER['SERVER_ADDR'];
            $target = shell_exec("hostname -I");
            $port = 11337;

            // Make sure it's a string, because of possible leading zeros.
            $nGroup = $settings->getWirelessPlugSocket()->getChannelCode();
            $nSwitch =  '0' . $settings->getWirelessPlugSocket()->getUnitCode();
            $nAction = '1';

            $output = $nGroup.$nSwitch.$nAction;

            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
            socket_bind($socket, $source) or die("Could not bind to socket\n");
            socket_connect($socket, $target, $port) or die("Could not connect to socket\n");
            socket_write($socket, $output, strlen ($output)) or die("Could not write output\n");
            socket_close($socket);

            $nAction = '0';

            $output = $nGroup.$nSwitch.$nAction;
            sleep($settings->getDurationPortion());

            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket here\n");
            socket_bind($socket, $source) or die("Could not bind to socket\n");
            socket_connect($socket, $target, $port) or die("Could not connect to socket\n");
            socket_write($socket, $output, strlen ($output)) or die("Could not write output\n");
            socket_close($socket);
        }

        return $this->render('AppBundle::feed.html.twig', array(
            'lightBarrierActive' => $lightBarrierActive,
            'feedForm' => $feedForm->createView(),
	        'barrierForm' => $barrierForm->createView(),
        ));
    }
}