<?php
/**
 * User: Simon Libaud
 * Date: 05/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use AppBundle\Entity\FinancialYear;
use AppBundle\Entity\Organisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\FinancialYearType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class FinancialYearController extends Controller
{

    /**
     * @param Organisation $organisation
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     */
    public function listAction(Organisation $organisation)
    {
        $financial_years = $this->getDoctrine()->getRepository('AppBundle:FinancialYear')
            ->createQueryBuilder('fy')
            ->join('fy.organisation', 'orga')
            ->where('orga = :organisation')
            ->orderBy('fy.start', 'ASC')
            ->setParameter('organisation', $organisation)
            ->getQuery()->getResult();

        return $this->render(':financial_year:list.html.twig', [
            'organisation' => $organisation,
            'financial_years' => $financial_years
        ]);
    }

    /**
     * @param Organisation $organisation
     * @param FinancialYear $financialYear
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     * @ParamConverter("financialYear", class="AppBundle:FinancialYear", options={"mapping"={"financial_year_id": "id"}})
     */
    public function infoAction(Organisation $organisation, FinancialYear $financialYear)
    {
        return $this->render(':financial_year:info.html.twig', [
            'organisation' => $organisation,
            'financialYear' => $financialYear
        ]);
    }

    /**
     * @param Request $request
     * @param Organisation $organisation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     */
    public function addAction(Request $request, Organisation $organisation)
    {
        $financialYear = (new FinancialYear())->setOrganisation($organisation);
        $form = $this->createForm(FinancialYearType::class, $financialYear);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($financialYear);
            $em->flush();
            $this->addFlash('success', 'addSuccess');
            return $this->redirectToRoute('app_financial_year_list', ['organisation_id' => $organisation->getId(), 'organisation_slug' => $organisation->getSlug()]);
        }

        return $this->render(':financial_year:form.html.twig', [
            'organisation' => $organisation,
            'form'  => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Organisation $organisation
     * @param FinancialYear $financialYear
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     * @ParamConverter("financialYear", class="AppBundle:FinancialYear", options={"mapping"={"financial_year_id": "id"}})
     */
    public function editAction(Request $request, Organisation $organisation, FinancialYear $financialYear)
    {
        $form = $this->createForm(FinancialYearType::class, $financialYear);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'editSuccess');
            return $this->redirectToRoute('app_financial_year_list', ['organisation_id' => $organisation->getId(), 'organisation_slug' => $organisation->getSlug()]);
        }

        return $this->render(':financial_year:form.html.twig', [
            'organisation' => $organisation,
            'financialYear' => $financialYear,
            'form'  => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Organisation $organisation
     * @param FinancialYear $financialYear
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     * @ParamConverter("financialYear", class="AppBundle:FinancialYear", options={"mapping"={"financial_year_id": "id"}})
     */
    public function removeAction(Request $request, Organisation $organisation, FinancialYear $financialYear)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($financialYear);
        $em->flush();
        $this->addFlash('success', 'removeSuccess');
        return $this->redirectToRoute('app_financial_year_list', ['organisation_id' => $organisation->getId(), 'organisation_slug' => $organisation->getSlug()]);
    }

}