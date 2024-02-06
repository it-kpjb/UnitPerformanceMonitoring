<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin', 
            'email' => 'superadmin@myapp.com',
            'password' => Hash::make('1q2w3e4r5t')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'admin@myapp.com',
            'password' => Hash::make('q1w2e3re4t5')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $adminDocument = User::create([
            'name' => 'Doc Admin', 
            'email' => 'docadmin@myapp.com',
            'password' => Hash::make('1z2x3c4v5b')
        ]);
        $adminDocument->assignRole('Admin Document');
    }
}