<?php
/**
 * User: Simon Libaud
 * Date: 25/03/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UserProfileController
 * @package AppBundle\Controller
 */
class UserAccountController extends Controller
{

    public function infoAction()
    {
        return $this->render(':user_account:info.html.twig');
    }
}