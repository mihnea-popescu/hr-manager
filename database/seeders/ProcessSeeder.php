<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationField;
use App\Models\Department;
use App\Models\Process;
use App\Models\ProcessField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Department::where('type', Department::RECRUITMENT)->with('users')->get() as $department) {
            foreach($department->users as $user) {
                $processes = Process::factory()
                    ->has(ProcessField::factory()->count(5 + rand(0, 10)), 'fields')
                    ->count(10 + rand(0, 10))
                    ->create([
                        'department_id' => $department->id,
                        'user_id' => $user->id
                    ]);

                foreach($processes as $process) {
                    $applications = Application::factory()
                        ->count(10 + rand(0, 10))
                        ->create([
                        'process_id' => $process->id
                    ]);

                    foreach($applications as $application) {
                        foreach($process->fields as $field) {
                            ApplicationField::create([
                                'application_id' => $application->id,
                                'field_id' => $field->id,
                                'value' => fake()->realText(150),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
