<?php
/**
 * User: Simon Libaud
 * Date: 05/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Organisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\FinancialYearType;

class FinancialYearController extends Controller
{

    /**
     * @param Request $request
     * @param Organisation $organisation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     */
    public function addController(Request $request, Organisation $organisation)
    {
        $form = $this->createForm(FinancialYearType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success', 'addSuccess');
            return $this->redirectToRoute('app_organisation_info', ['organisation_id' => $organisation->getId(), 'organisation_slug' => $organisation->getSlug()]);
        }

        return $this->render(':financial_year:form.html.twig', [
            'organisation' => $organisation,
            'form'  => $form->createView()
        ]);
    }

}