<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getAllUsers()
    {
        $roles = $this->roles;
        $users = new Collection();
        foreach($roles as $role)
        {
            foreach($role->users as $user)
            {
                $users->push($user);
            }
        }
        return $users;
    }

}
