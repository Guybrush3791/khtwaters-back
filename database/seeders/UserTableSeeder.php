<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::findByName('admin', 'api');
        $userRole = Role::findByName('user', 'api');

        $user = new User();
        $user -> name = 'Guybrush';
        $user -> email = 'guybrush@mail.com';
        $user -> password = bcrypt('pws');
        $user -> assignRole($adminRole);
        $user -> save();

        $user = new User();
        $user -> name = 'Stan';
        $user -> email = 'stan@mail.com';
        $user -> password = bcrypt('pws');
        $user -> assignRole($userRole);
        $user -> save();

        $user = new User();
        $user -> name = 'Otis';
        $user -> email = 'otis@mail.com';
        $user -> password = bcrypt('pws');
        $user -> assignRole($userRole);
        $user -> save();
    }
}
