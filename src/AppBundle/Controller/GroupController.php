<?php
/**
 * User: Simon Libaud
 * Date: 26/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\GroupType;
use AppBundle\Form\RemoveConfirmationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class GroupController extends Controller
{

    /**
     * List of groups
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        return $this->render(':group:list.html.twig', [
            'groups' => $this->getDoctrine()->getRepository('AppBundle:Group')->findBy([], ['name' => 'ASC'])
        ]);
    }

    /**
     * Add group
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(GroupType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $group = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

            $this->addFlash('success', 'addSuccess');
            return $this->redirectToRoute('app_group_list');
        }

        return $this->render(':group:form.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    /**
     * Edit group
     *
     * @param Request $request
     * @param Group $group
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @paramConverter("group", class="AppBundle:Group", options={"mapping"={"group_id": "id", "group_slug": "slug"}})
     */
    public function editAction(Request $request, Group $group)
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'editSuccess');

            return $this->redirectToRoute('app_group_list');
        }

        return $this->render(':group:form.html.twig', [
            'group' => $group,
            'form'  => $form->createView()
        ]);
    }

    /**
     * Remove group
     *
     * @param Request $request
     * @param Group $group
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @paramConverter("group", class="AppBundle:Group", options={"mapping"={"group_id": "id", "group_slug": "slug"}})
     */
    public function removeAction(Request $request, Group $group)
    {
        if ($this->getUser()->getGroup() === $group) {
            $this->addFlash('error', 'youCantRemoveYourOwnGroup');
            return $this->redirectToRoute('app_group_list');
        }
        $form = $this->createForm(RemoveConfirmationType::class);
        $form->handleRequest($request);

        if ((false === $group->hasChild()) || ($form->isSubmitted() and $form->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush();
            $this->addFlash('success', 'removeSuccess');;
            return $this->redirectToRoute('app_group_list');
        }
        return $this->render(':group:remove.html.twig', [
            'group' => $group,
            'form'    => $form->createView()
        ]);
    }

}