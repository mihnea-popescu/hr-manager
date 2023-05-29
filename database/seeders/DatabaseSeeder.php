<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\DepartmentUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin accounts
        \App\Models\User::factory()->create([
            'name' => 'Mihnea Popescu',
            'email' => 'mihnea.popescu1@s.unibuc.ro',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'is_admin' => 1,
            'profile_pic' => 'https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Robert Șamata',
            'email' => 'robert.samata@s.unibuc.ro',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'is_admin' => 1,
            'profile_pic' => 'https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg',
        ]);

        // Seed departments
        (new DepartmentSeeder)->run();

        // Seed departments users
        (new DepartmentUserSeeder)->run();

        // Seed processes
        (new ProcessSeeder)->run();
    }
}
