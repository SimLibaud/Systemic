<?php
/**
 * User: Simon Libaud
 * Date: 26/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends Controller
{

    /**
     * List of users
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        return $this->render(':user:list.html.twig', [
            'users' => $this->getDoctrine()->getRepository('AppBundle:User')->findBy([], ['lastname' => 'ASC']),
        ]);
    }

    /**
     * Add user
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $user->setSalt(md5(uniqid()));
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'addSuccess');
            return $this->redirectToRoute('app_user_list');
        }

        return $this->render(':user:form.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    /**
     * Edit user
     *
     * @param Request $request
     * @param User $user
     * @ParamConverter("user", class= "AppBundle:User", options={"mapping"={"user_id": "id"}})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'editSuccess');
            return $this->redirectToRoute('app_user_list');
        }

        return $this->render(':user:form.html.twig', [
            'user'  => $user,
            'form'  => $form->createView()
        ]);
    }

    /**
     * Remove user
     *
     * @param Request $request
     * @param User $user
     * @ParamConverter("user", class= "AppBundle:User", options={"mapping"={"user_id": "id"}})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'removeSuccess');
        return $this->redirectToRoute('app_user_list');
    }


}