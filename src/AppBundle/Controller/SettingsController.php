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
            // execute script
//            $command = escapeshellcmd('../../../../app/Resources/py/feed.py');
            $command2 = trim('python /var/www/html/cat-feeder/app/Resources/py/feed.py ' . $settings->getWirelessPlugSocket()->getChannelCode() . ' ' .
                                      $settings->getWirelessPlugSocket()->getUnitCode() . ' ' . $settings->getDurationPortion());
dump($command2);
$output2 = null;
$returnVar = null;
$output = exec($command2, $output2, $returnVar);
            dump($output);
dump($output2);
dump($returnVar);
        }

        return $this->render('AppBundle::settings.html.twig', array(
            'form' => $form->createView(),
            'isFormSaved' => $isFormSaved
        ));
    }
}