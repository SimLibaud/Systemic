<?php
/**
 * User: Simon Libaud
 * Date: 05/03/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use AppBundle\Form\EmployeeType;
use AppBundle\Entity\Employee;
use AppBundle\Entity\Organisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\RemoveConfirmationType;

class EmployeeController extends Controller
{
    /**
     * List of organisation's employees
     *
     * @param Organisation $organisation
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Organisation $organisation)
    {
        $employees = $this->getDoctrine()->getRepository('AppBundle:Employee')->findBy(['organisation' => $organisation], ['lastname' => 'ASC']);

        return $this->render(':employee:list.html.twig', [
            'organisation' => $organisation,
            'employees' => $employees
        ]);
    }

    /**
     * Add employee to organisation
     *
     * @param Organisation $organisation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     */
    public function addAction(Organisation $organisation, Request $request)
    {
        $employee = (new Employee())->setOrganisation($organisation);
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            $this->addFlash('success', 'addSuccess');
            return $this->redirectToRoute('app_employee_list', [
                'organisation_id' => $organisation->getId(),
                'organisation_slug' => $organisation->getSlug()
            ]);
        }

        return $this->render(':employee:form.html.twig', [
            'organisation' => $organisation,
            'form' => $form->createView()
        ]);
    }

    /**
     * Edit employee
     *
     * @param Organisation $organisation
     * @param Employee $employee
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     * @ParamConverter("employee", class="AppBundle:Employee", options={"mapping"={"employee_id": "id"}})
     */
    public function editAction(Organisation $organisation, Employee $employee, Request $request)
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'editSuccess');
            return $this->redirectToRoute('app_employee_list', [
                'organisation_id' => $organisation->getId(),
                'organisation_slug' => $organisation->getSlug()
            ]);
        }

        return $this->render(':employee:form.html.twig', [
            'organisation' => $organisation,
            'form' => $form->createView(),
            'employee' => $employee
        ]);
    }

    /**
     * Remove employee
     *
     * @param Organisation $organisation
     * @param Employee $employee
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @ParamConverter("organisation", class="AppBundle:Organisation", options={"mapping"={"organisation_id": "id", "organisation_slug": "slug"}})
     * @ParamConverter("employee", class="AppBundle:Employee", options={"mapping"={"employee_id": "id"}})
     */
    public function removeAction(Organisation $organisation, Employee $employee, Request $request)
    {
        $form = $this->createForm(RemoveConfirmationType::class);
        $form->handleRequest($request);

        if(false === $employee->hasChild() || ($form->isSubmitted() and $form->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
            $this->addFlash('success', 'removeSuccess');;
            return $this->redirectToRoute('app_employee_list', [
                'organisation_id' => $organisation->getId(),
                'organisation_slug' => $organisation->getSlug()
            ]);
        }

        return $this->render(':employee:remove.html.twig', [
            'employee' => $employee,
            'organisation' => $organisation,
            'form'    => $form->createView()
        ]);


    }
}