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
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings")
     */
    public function settingsAction(Request $request)
    {
        return $this->render('default/settings.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}