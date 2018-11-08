<?php

namespace IntakeBundle\Controller;

use IntakeBundle\Entity\Locatie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Locatie controller.
 *
 * @Route("locatie")
 */
class LocatieController extends Controller
{
    /**
     * Lists all locatie entities.
     *
     * @Route("/", name="locatie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locaties = $em->getRepository('IntakeBundle:Locatie')->findAll();

        return $this->render('@Intake/locatie/index.html.twig', array(
            'locaties' => $locaties,
        ));
    }

    /**
     * Creates a new locatie entity.
     *
     * @Route("/new", name="locatie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $locatie = new Locatie();
        $form = $this->createForm('IntakeBundle\Form\LocatieType', $locatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locatie);
            $em->flush();

            return $this->redirectToRoute('locatie_show', array('id' => $locatie->getId()));
        }

        return $this->render('@Intake/locatie/new.html.twig', array(
            'locatie' => $locatie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a locatie entity.
     *
     * @Route("/{id}", name="locatie_show")
     * @Method("GET")
     */
    public function showAction(Locatie $locatie)
    {
        $deleteForm = $this->createDeleteForm($locatie);

        return $this->render('@Intake/locatie/show.html.twig', array(
            'locatie' => $locatie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing locatie entity.
     *
     * @Route("/{id}/edit", name="locatie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Locatie $locatie)
    {
        $deleteForm = $this->createDeleteForm($locatie);
        $editForm = $this->createForm('IntakeBundle\Form\LocatieType', $locatie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('locatie_edit', array('id' => $locatie->getId()));
        }

        return $this->render('@Intake/locatie/edit.html.twig', array(
            'locatie' => $locatie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a locatie entity.
     *
     * @Route("/{id}", name="locatie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Locatie $locatie)
    {
        $form = $this->createDeleteForm($locatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($locatie);
            $em->flush();
        }

        return $this->redirectToRoute('locatie_index');
    }

    /**
     * Creates a form to delete a locatie entity.
     *
     * @param Locatie $locatie The locatie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Locatie $locatie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('locatie_delete', array('id' => $locatie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
