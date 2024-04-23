<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        // $roleAdmin->givePermissionTo($permissionEdit);
        // $roleAdmin->givePermissionTo($permissionDelete);

        $roleUser = Role::create(['name' => 'user', 'guard_name' => 'api']);
    }
}
