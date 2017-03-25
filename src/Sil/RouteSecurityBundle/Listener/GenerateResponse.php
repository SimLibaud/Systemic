<?php
/**
 * User: Simon Libaud
 * Date: 22/03/2017
 * Email: simonlibaud@gmail.com
 */

namespace Sil\RouteSecurityBundle\Listener;


use Sil\RouteSecurityBundle\Event\AccessDeniedToRouteEvent;
use Symfony\Component\HttpFoundation\Response;

class GenerateResponse
{

    public function generateResponse(AccessDeniedToRouteEvent $event)
    {
        $response = new Response('Oups, il semblerait que vous ne disposiez pas des droits nécessaires pour accéder à la page demandée.', 403);
        $event->setResponse($response);
    }

}