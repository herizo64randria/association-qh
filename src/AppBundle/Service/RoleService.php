<?php
/**
 * Created by PhpStorm.
 * User: Allin RAMANAMPISOA
 * Date: 31/01/2019
 * Time: 15:50
 */

namespace AppBundle\Service;

use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use UserBundle\Entity\User;

class RoleService
{
    private $roleHierarchy;

    /**
     * Constructor
     *
     * @param RoleHierarchyInterface $roleHierarchy
     */
    public function __construct(RoleHierarchyInterface $roleHierarchy)
    {

        $this->roleHierarchy = $roleHierarchy;
    }

    /**
     * isGranted
     *
     * @param string $role
     * @param $user
     * @return bool
     */
    public function isGranted($role, User $user) {

        $role = new Role($role);

        foreach($user->getRoles() as $userRole) {
            if (in_array($role, $this->roleHierarchy->getReachableRoles(array(new Role($userRole)))))
                return true;
        }

        return false;
    }
}