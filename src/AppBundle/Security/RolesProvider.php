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

    public function __construct()
    {

    }

    /**
     * Return all roles implemented by the application
     *
     * @return role
     */
    public function getAppRoles()
    {
        return [User::ROLE_DEFAULT, 'ROLE_ACCESS_TO_ALL_ORGANISATIONS'];
    }

}