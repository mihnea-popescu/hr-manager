<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentsData = [
            [
                'name' => 'Recrutare și Achiziție de Talente',
                'icon' => 'comet',
                'type' => Department::RECRUITMENT,
            ],
            [
                'name' => 'Relații cu Angajații',
                'icon' => 'circles-relation',
                'type' => Department::PR,
            ],
            [
                'name' => 'Instruire și Dezvoltare',
                'icon' => 'trending-up',
                'type' => Department::GROWTH,
            ],
            [
                'name' => 'Managementul Performanței',
                'icon' => 'bolt',
                'type' => Department::PERFORMANCE,
            ]
        ];

        $departments = [];

        foreach($departmentsData as $data) {
            $department = new Department;

            $department->name = $data['name'];
            $department->icon = $data['icon'];
            $department->type = $data['type'];

            $department->save();

            $departments[] = $department;
        }
    }
}
