<?php
/**
 * Created by PhpStorm.
 * User: kinske
 * Date: 30.03.16
 * Time: 15:12
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class FeedController extends Controller
{
    /**
     * @Route("/feed", name="feed")
     * @Route ("/", name="home_feed")
     */
    public function feedAction(Request $request)
    {
        $formData = [];
        $form = $this->createFormBuilder($formData, array(
            'csrf_protection' => false,
	    'allow_extra_fields' => true
        ))
        ->add('hiddenField', TextType::class, array('required' => false))
        ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $source = $_SERVER['SERVER_ADDR'];
            $target = shell_exec("hostname -I");
            $port = 11337;

            $nGroup = "11010";
            $nSwitch = "04";
            $nAction = "1";

            $output = $nGroup.$nSwitch.$nAction;

            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
            socket_bind($socket, $source) or die("Could not bind to socket\n");
            socket_connect($socket, $target, $port) or die("Could not connect to socket\n");
            socket_write($socket, $output, strlen ($output)) or die("Could not write output\n");
            socket_close($socket);

            $nAction = "0";

            $output = $nGroup.$nSwitch.$nAction;
            sleep(1);

            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket here\n");
            socket_bind($socket, $source) or die("Could not bind to socket\n");
            socket_connect($socket, $target, $port) or die("Could not connect to socket\n");
            socket_write($socket, $output, strlen ($output)) or die("Could not write output\n");
            socket_close($socket);
        }

        return $this->render('AppBundle::feed.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}