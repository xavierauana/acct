<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 18/3/15
 * Time: 6:00 PM
 */

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::create(array(
            'name'=>'Xavier Au',
            'email' => 'xavier.au@gmail.com',
            'password' => Hash::make('aukaiyuen')
        ));

    }
}