<?php
/**
 * User: Simon Libaud
 * Date: 26/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\LoginType;

class SecurityController extends Controller
{

    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(':security:login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'form'          => $this->createForm(LoginType::class)->createView()
        ]);
    }

}