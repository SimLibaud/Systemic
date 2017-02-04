<?php
/**
 * User: Simon Libaud
 * Date: 04/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SocietyType;

class SocietyController extends Controller
{

    /**
     * List of society
     */
    public function listAction()
    {
        $societies = $this->getDoctrine()->getRepository('AppBundle:Society')->findAll();

        return $this->render(':society:list.html.twig', [
            'societies' => $societies
        ]);
    }

    /**
     * Add society
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(SocietyType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('app_society_list');
        }

        return $this->render(':society:form.html.twig', [
            'form'  => $form->createView()
        ]);
    }

}