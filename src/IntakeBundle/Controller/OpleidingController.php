<?php

namespace IntakeBundle\Controller;

use IntakeBundle\Entity\Opleiding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Opleiding controller.
 *
 * @Route("opleiding")
 */
class OpleidingController extends Controller
{
    /**
     * Lists all opleiding entities.
     *
     * @Route("/", name="opleiding_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $opleidings = $em->getRepository('IntakeBundle:Opleiding')->findAll();

        return $this->render('@Intake/opleiding/index.html.twig', array(
            'opleidings' => $opleidings,
        ));
    }

    /**
     * Creates a new opleiding entity.
     *
     * @Route("/new", name="opleiding_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $opleiding = new Opleiding();
        $form = $this->createForm('IntakeBundle\Form\OpleidingType', $opleiding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($opleiding);
            $em->flush();

            return $this->redirectToRoute('opleiding_show', array('id' => $opleiding->getId()));
        }

        return $this->render('@Intake/opleiding/new.html.twig', array(
            'opleiding' => $opleiding,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a opleiding entity.
     *
     * @Route("/{id}", name="opleiding_show")
     * @Method("GET")
     */
    public function showAction(Opleiding $opleiding)
    {
        $deleteForm = $this->createDeleteForm($opleiding);

        return $this->render('@Intake/opleiding/show.html.twig', array(
            'opleiding' => $opleiding,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing opleiding entity.
     *
     * @Route("/{id}/edit", name="opleiding_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Opleiding $opleiding)
    {
        $deleteForm = $this->createDeleteForm($opleiding);
        $editForm = $this->createForm('IntakeBundle\Form\OpleidingType', $opleiding);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('opleiding_edit', array('id' => $opleiding->getId()));
        }

        return $this->render('@Intake/opleiding/edit.html.twig', array(
            'opleiding' => $opleiding,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a opleiding entity.
     *
     * @Route("/{id}", name="opleiding_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Opleiding $opleiding)
    {
        $form = $this->createDeleteForm($opleiding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($opleiding);
            $em->flush();
        }

        return $this->redirectToRoute('opleiding_index');
    }

    /**
     * Creates a form to delete a opleiding entity.
     *
     * @param Opleiding $opleiding The opleiding entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Opleiding $opleiding)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opleiding_delete', array('id' => $opleiding->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
