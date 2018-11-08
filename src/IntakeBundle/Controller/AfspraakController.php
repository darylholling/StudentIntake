<?php

namespace IntakeBundle\Controller;

use IntakeBundle\Entity\Afspraak;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Afspraak controller.
 *
 * @Route("afspraak")
 */
class AfspraakController extends Controller
{
    /**
     * Lists all afspraak entities.
     *
     * @Route("/", name="afspraak_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $afspraaks = $em->getRepository('IntakeBundle:Afspraak')->findAll();

        return $this->render('@Intake/afspraak/index.html.twig', array(
            'afspraaks' => $afspraaks,
        ));
    }

    /**
     * Creates a new afspraak entity.
     *
     * @Route("/new", name="afspraak_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $afspraak = new Afspraak();
        $form = $this->createForm('IntakeBundle\Form\AfspraakType', $afspraak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($afspraak);
            $em->flush();

            return $this->redirectToRoute('afspraak_show', array('id' => $afspraak->getId()));
        }

        return $this->render('@Intake/afspraak/new.html.twig', array(
            'afspraak' => $afspraak,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a afspraak entity.
     *
     * @Route("/{id}", name="afspraak_show")
     * @Method("GET")
     */
    public function showAction(Afspraak $afspraak)
    {
        $deleteForm = $this->createDeleteForm($afspraak);

        return $this->render('@Intake/afspraak/show.html.twig', array(
            'afspraak' => $afspraak,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing afspraak entity.
     *
     * @Route("/{id}/edit", name="afspraak_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Afspraak $afspraak)
    {
        $deleteForm = $this->createDeleteForm($afspraak);
        $editForm = $this->createForm('IntakeBundle\Form\AfspraakType', $afspraak);
        $editForm->handleRequest($request);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $afspraak->setUserId($user);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('afspraak_edit', array('id' => $afspraak->getId()));
        }

        return $this->render('@Intake/afspraak/edit.html.twig', array(
            'afspraak' => $afspraak,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a afspraak entity.
     *
     * @Route("/{id}", name="afspraak_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Afspraak $afspraak)
    {
        $form = $this->createDeleteForm($afspraak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($afspraak);
            $em->flush();
        }

        return $this->redirectToRoute('afspraak_index');
    }

    /**
     * Creates a form to delete a afspraak entity.
     *
     * @param Afspraak $afspraak The afspraak entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Afspraak $afspraak)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('afspraak_delete', array('id' => $afspraak->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
