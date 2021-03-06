<?php
/**
 * User: Simon Libaud
 * Date: 04/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Organisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\OrganisationType;
use AppBundle\Form\RemoveConfirmationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class OrganisationController extends Controller
{

    /**
     * List of organisations
     */
    public function listAction()
    {
        $organisations = $this->getDoctrine()->getRepository('AppBundle:Organisation')
            ->createQueryBuilder('organisation')
            ->join('organisation.users', 'user')
            ->leftJoin('organisation.employees', 'employees')
            ->leftJoin('organisation.financial_years', 'financial_year')
            ->where('user = :user')
            ->addOrderBy('organisation.name', 'ASC')
            ->setParameter('user', $this->getUser())
            ->addSelect('employees', 'financial_year')
            ->getQuery()->getArrayResult();

        return $this->render(':organisation:list.html.twig', [
            'organisations' => $organisations
        ]);
    }

    /**
     * Info of organisation
     *
     * @param Organisation $organisation
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     */
    public function infoAction(Organisation $organisation)
    {
        return $this->render(':organisation:info.html.twig', [
            'organisation'  => $organisation
        ]);
    }

    /**
     * Add organisation
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(OrganisationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success', 'addSuccess');
            return $this->redirectToRoute('app_organisation_list');
        }

        return $this->render(':organisation:form.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    /**
     * Edit organisation
     *
     * @param Request $request
     * @param Organisation $organisation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     */
    public function editAction(Request $request, Organisation $organisation)
    {
        $form = $this->createForm(OrganisationType::class, $organisation);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'editSuccess');
            return $this->redirectToRoute('app_organisation_list');
        }
        return $this->render(':organisation:form.html.twig', [
            'society'   => $organisation,
            'form'      => $form->createView()
        ]);
    }

    /**
     * Remove organisation
     *
     * @param Request $request
     * @param Organisation $organisation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     */
    public function removeAction(Request $request, Organisation $organisation)
    {
        $form = $this->createForm(RemoveConfirmationType::class);
        $form->handleRequest($request);

        if ((false === $organisation->hasChild()) or ($form->isSubmitted() and $form->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organisation);
            $em->flush();
            $this->addFlash('success', 'removeSuccess');;
            return $this->redirectToRoute('app_organisation_list');
        }
        return $this->render(':organisation:remove.html.twig', [
            'society' => $organisation,
            'form'    => $form->createView()
        ]);
    }

}