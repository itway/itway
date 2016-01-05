<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Itway\Models\User;

class AdminSeeder extends Seeder
{

    /**
     */
    public function __construct()
    {

    }

    /**
     *
     */
    public function run()
    {

        Model::unguard();


        $user = User::UpdateOrCreate([
            'name' => 'admin',

            'email' => 'admin@admin.com',

            'password' => 'admin'
        ]);

        $user->attachRole(1);

        $user = User::UpdateOrCreate([
            'name' => 'nikole',

            'email' => 'nikole@nikole.com',

            'password' => 'nikole'
        ]);

        $user->attachRole(2);

        $user = User::UpdateOrCreate([
            'name' => 'nil',

            'email' => 'nil@nil.com',

            'password' => 'nil'
        ]);

        $user->attachRole(3);
}


//    /**
//     * @param $user
//     */
//    public function createAdmin($user) {
//
//    }

/**
 * @param $user
 */
//    public function deleteAdmin($userAdmin) {
//
//        $this->rolesAndPermissions->deleteAdminAccess($userAdmin);
//
//    }
}
