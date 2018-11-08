<?php

namespace IntakeBundle\Controller;

use IntakeBundle\Entity\Afdeling;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Afdeling controller.
 *
 * @Route("afdeling")
 */
class AfdelingController extends Controller
{
    /**
     * Lists all afdeling entities.
     *
     * @Route("/", name="afdeling_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $afdelings = $em->getRepository('IntakeBundle:Afdeling')->findAll();

        return $this->render('@Intake/afdeling/index.html.twig', array(
            'afdelings' => $afdelings,
        ));
    }

    /**
     * Creates a new afdeling entity.
     *
     * @Route("/new", name="afdeling_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $afdeling = new Afdeling();
        $form = $this->createForm('IntakeBundle\Form\AfdelingType', $afdeling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($afdeling);
            $em->flush();

            return $this->redirectToRoute('afdeling_show', array('id' => $afdeling->getId()));
        }

        return $this->render('@Intake/afdeling/new.html.twig', array(
            'afdeling' => $afdeling,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a afdeling entity.
     *
     * @Route("/{id}", name="afdeling_show")
     * @Method("GET")
     */
    public function showAction(Afdeling $afdeling)
    {
        $deleteForm = $this->createDeleteForm($afdeling);

        return $this->render('@Intake/afdeling/show.html.twig', array(
            'afdeling' => $afdeling,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing afdeling entity.
     *
     * @Route("/{id}/edit", name="afdeling_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Afdeling $afdeling)
    {
        $deleteForm = $this->createDeleteForm($afdeling);
        $editForm = $this->createForm('IntakeBundle\Form\AfdelingType', $afdeling);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('afdeling_edit', array('id' => $afdeling->getId()));
        }

        return $this->render('@Intake/afdeling/edit.html.twig', array(
            'afdeling' => $afdeling,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a afdeling entity.
     *
     * @Route("/{id}", name="afdeling_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Afdeling $afdeling)
    {
        $form = $this->createDeleteForm($afdeling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($afdeling);
            $em->flush();
        }

        return $this->redirectToRoute('afdeling_index');
    }

    /**
     * Creates a form to delete a afdeling entity.
     *
     * @param Afdeling $afdeling The afdeling entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Afdeling $afdeling)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('afdeling_delete', array('id' => $afdeling->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
