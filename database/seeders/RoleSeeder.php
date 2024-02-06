<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $adminDocument = Role::create(['name' => 'Admin Document']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-docsMon',
            'edit-docsMon',
            'delete-docsMon'
        ]);

        $adminDocument->givePermissionTo([
            'create-docsMon',
            'edit-docsMon',
            'delete-docsMon'
        ]);
    }
}
