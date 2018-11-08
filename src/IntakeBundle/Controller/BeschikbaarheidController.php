<?php

namespace IntakeBundle\Controller;

use IntakeBundle\Entity\Beschikbaarheid;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Beschikbaarheid controller.
 *
 * @Route("beschikbaarheid")
 */
class BeschikbaarheidController extends Controller
{
    /**
     * Lists all beschikbaarheid entities.
     *
     * @Route("/", name="beschikbaarheid_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $beschikbaarheids = $em->getRepository('IntakeBundle:Beschikbaarheid')->findAll();

        return $this->render('@Intake/beschikbaarheid/index.html.twig', array(
            'beschikbaarheids' => $beschikbaarheids,
        ));
    }

    /**
     * Creates a new beschikbaarheid entity.
     *
     * @Route("/new", name="beschikbaarheid_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $beschikbaarheid = new Beschikbaarheid();
        $form = $this->createForm('IntakeBundle\Form\BeschikbaarheidType', $beschikbaarheid);
        $form->handleRequest($request);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $beschikbaarheid->setDocentId($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($beschikbaarheid);
            $em->flush();

            return $this->redirectToRoute('beschikbaarheid_show', array('id' => $beschikbaarheid->getId()));
        }

        return $this->render('@Intake/beschikbaarheid/new.html.twig', array(
            'beschikbaarheid' => $beschikbaarheid,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a beschikbaarheid entity.
     *
     * @Route("/{id}", name="beschikbaarheid_show")
     * @Method("GET")
     */
    public function showAction(Beschikbaarheid $beschikbaarheid)
    {
        $deleteForm = $this->createDeleteForm($beschikbaarheid);

        return $this->render('@Intake/beschikbaarheid/show.html.twig', array(
            'beschikbaarheid' => $beschikbaarheid,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing beschikbaarheid entity.
     *
     * @Route("/{id}/edit", name="beschikbaarheid_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Beschikbaarheid $beschikbaarheid)
    {
        $deleteForm = $this->createDeleteForm($beschikbaarheid);
        $editForm = $this->createForm('IntakeBundle\Form\BeschikbaarheidType', $beschikbaarheid);
        $editForm->handleRequest($request);



        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('beschikbaarheid_edit', array('id' => $beschikbaarheid->getId()));
        }

        return $this->render('@Intake/beschikbaarheid/edit.html.twig', array(
            'beschikbaarheid' => $beschikbaarheid,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a beschikbaarheid entity.
     *
     * @Route("/{id}", name="beschikbaarheid_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Beschikbaarheid $beschikbaarheid)
    {
        $form = $this->createDeleteForm($beschikbaarheid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($beschikbaarheid);
            $em->flush();
        }

        return $this->redirectToRoute('beschikbaarheid_index');
    }

    /**
     * Creates a form to delete a beschikbaarheid entity.
     *
     * @param Beschikbaarheid $beschikbaarheid The beschikbaarheid entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Beschikbaarheid $beschikbaarheid)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('beschikbaarheid_delete', array('id' => $beschikbaarheid->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
