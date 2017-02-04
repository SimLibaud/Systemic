<?php
/**
 * User: Simon Libaud
 * Date: 03/02/2017
 * Email: simonlibaud@gmail.com
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{

    /**
     *
     */
    public function homeAction()
    {
        return $this->render(':default:home.html.twig');
    }

}
