<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addRolesAndPermissions();
    }

    private function addRolesAndPermissions()
    {
        // create permissions for an admin
        $adminPermissions = collect(['create user', 'edit user', 'delete user'])->map(function ($name) {
            return Permission::create(['name' => $name]);
        });

        // add admin role
        $adminRole = Role::create(['name' => 'Owner']);
        $adminRole->givePermissionTo($adminPermissions);

        // add a default user role
        Role::create(['name' => 'Accounting']);
        Role::create(['name' => 'Websites']);
        Role::create(['name' => 'Products']);

        User::find(1)->assignRole('Owner');
    }
}
