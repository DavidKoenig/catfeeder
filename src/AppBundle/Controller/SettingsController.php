<?php
/**
 * Created by PhpStorm.
 * User: kinske
 * Date: 30.03.16
 * Time: 15:12
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Settings;
use AppBundle\Form\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings")
     */
    public function settingsAction(Request $request)
    {
        // There has to be only one setting.
        $settings = $this->getDoctrine()->getRepository('AppBundle:Settings')->findAll();
        // If there is no setting create a new one --> later maybe in deploy script.
        $settings = $settings ? $settings[0] : new Settings();

        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);
        $isFormSaved = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($settings);
            $em->flush();
            $isFormSaved = true;

            $source = $_SERVER['SERVER_ADDR'];
            $target = shell_exec("hostname -I");
            $port = 11337;

            $nGroup = "11010";
            $nSwitch = "04";
            $nAction = "1";

            $output = $nGroup.$nSwitch.$nAction;

            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket here\n");
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

        return $this->render('AppBundle::settings.html.twig', array(
            'form' => $form->createView(),
            'isFormSaved' => $isFormSaved
        ));
    }
}