<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;

/**
 * User: Simon Libaud
 * Date: 05/03/2017
 * Email: simonlibaud@gmail.com
 */
class RolesProvider
{

    private $roles_for_routes;

    public function __construct($roles_for_routes)
    {
        $this->roles_for_routes = $roles_for_routes;
    }

    /**
     * Return all roles implemented by the application
     *
     * @return role
     */
    public function getAppRoles()
    {
        return $this->roles_for_routes;
    }

}