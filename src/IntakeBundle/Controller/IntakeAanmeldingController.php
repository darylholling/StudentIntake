<?php
/**
 * Created by PhpStorm.
 * User: Daryl
 * Date: 20-6-2018
 * Time: 23:52
 */

namespace IntakeBundle\Controller;

use IntakeBundle\Entity\Afspraak;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Inschrijving controller.
 *
 * @Route("inschrijven")
 */
class IntakeAanmeldingController extends Controller
{
    /**
     * Creates a new inschrijving entity.
     *
     * @Route("/", name="inschrijven_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $afspraak = new Afspraak();
        $form = $this->createForm('IntakeBundle\Form\InschrijvenType', $afspraak);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form->handleRequest($request);
        $afspraak->setUserId($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($afspraak);
            $em->flush();

            return $this->redirectToRoute('afspraak_show', array('id' => $afspraak->getId()));
        }

        return $this->render('@Intake/inschrijven/new.html.twig', array(
            'afspraak' => $afspraak,
            'form' => $form->createView(),
        ));
    }
}