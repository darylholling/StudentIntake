<?php

namespace IntakeBundle\Controller;

use IntakeBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('IntakeBundle:User')->findAll();

        return $this->render('@Intake/user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Lists all invoice entities.
     *
     * @Route("/{id}", name="role_action")
     * @Method("GET")
     */
    public function roleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //Get the user with name admin
        $user = $em->getRepository("IntakeBundle:User")->find($id);

        if ($user) {
            if (in_array("ROLE_SUPER_ADMIN", $user->getRoles())) {
                $user->removeRole("ROLE_SUPER_ADMIN");
            } else {
                //Set the admin role
                $user->addRole("ROLE_SUPER_ADMIN");
                //$user->removeRole("ROLE_USER");
            }
            //Save it to the database
            $em->persist($user);
            $em->flush();
        }
        $users = $em->getRepository('IntakeBundle:User')->findAll();

        return $this->render('@Intake/user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a userprofile entity.
     *
     * @Route("/profile/{id}", name="profile_show")
     * @Method("GET")
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('IntakeBundle:User')->findAll();

        return $this->render('@Intake/Profile/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Displays a form to edit an existing profiel entity.
     *
     * @Route("/profile/{id}/edit", name="profiel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('IntakeBundle\Form\ProfielType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_show', array('id' => $user->getId()));
        }

        return $this->render('@Intake/Profile/edit.html.twig', array(
            'users' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }
}
