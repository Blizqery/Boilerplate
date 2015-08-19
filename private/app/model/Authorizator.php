<?php
/**
 * Authorizator.php.
 * User: Ladislav Tomsa
 * Date: 11. 7. 2015
 * Time: 14:33
 */

namespace App;

use Nette\Security as NS;


class Authorizator extends NS\Permission implements NS\IAuthorizator
{
    // User roles
    const GUEST = 'guest';
    const EMPLOYEE = 'employee';
    const USER = 'user';
    const MODERATOR = 'moderator';
    const ADMIN = 'admin';

    /**
     * Construct
     */
    public function __construct()
    {
        $this->setRoles();
        $this->setResources();
        $this->denied();
        $this->allowed();
    }

    private function denied()
    {
        // Guest
        $this->deny(self::GUEST, array(
            'Admin:*'
        ));

        // Employee
        $this->deny(self::EMPLOYEE, array());

        // User
        $this->deny(self::USER, array());

        // Moderator
        $this->deny(self::MODERATOR, array());
    }

    private function allowed()
    {
        // Guest
        $this->allow(self::GUEST, array());

        // Employee
        $this->allow(self::EMPLOYEE, array());

        // User
        $this->allow(self::USER, array());

        // Moderator
        $this->allow(self::MODERATOR, array());

        // Administrator has access to all resources
        $this->allow(self::ADMIN, NS\Permission::ALL);
    }

    /**
     * Role definition
     */
    private function setRoles()
    {
        $this->addRole(self::GUEST);
        $this->addRole(self::EMPLOYEE, self::GUEST);
        $this->addRole(self::USER, self::EMPLOYEE);
        $this->addRole(self::MODERATOR, self::USER);
        $this->addRole(self::ADMIN, self::MODERATOR);
    }

    /**
     * Resource definition
     */
    private function setResources()
    {
        // Administrace
        $this->setResources("Admin:*");
    }
}