<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Department::all() as $department) {
            $users = \App\Models\User::factory(20 + rand(3, 33))->create();

            $usersData = [];

            foreach($users as $user) {
                $usersData[$user->id] = [
                    'created_at' => now()->subDays(rand(365, 730))->subMinutes(rand(0, 59))->subHours(rand(0, 12))->subSeconds(rand(0, 59)),
                    'updated_at' => now()->subDays(rand(0, 364))->subMinutes(rand(0, 59))->subHours(rand(0, 12))->subSeconds(rand(0, 59)),
                    'manager' => $user->id == $users->first()->id ? 1 : 0,
                ];
            }

            $department->users()->attach($usersData);
        }
    }
}
