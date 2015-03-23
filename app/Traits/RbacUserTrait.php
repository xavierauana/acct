<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 23/3/15
 * Time: 2:20 PM
 */

namespace App\Traits;


use App\Role;

trait RbacUserTrait {

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function can($check)
    {
        $roles = $this->roles;
        $permissions = $this->fetchPermissions($roles);
        return in_array($check, $permissions);
    }

    public function getAllPermissions()
    {
        $roles = $this->roles;
        $permissions = $this->fetchPermissions($roles);
        return $permissions;
    }

    public function attachRole(Role $role)
    {
        return $this->roles()->attach($role->id);
    }

    /**
     * @param $roles
     *
     * @return array
     */
    private function fetchPermissions($roles)
    {
        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                if (!in_array($permission->name, $permissions)) $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }
}