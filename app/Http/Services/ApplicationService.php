<?php

namespace App\Http\Services;

use App\Models\Application;
use App\Models\ApplicationField;
use App\Models\Process;

class ApplicationService {
    public function store(Process $process, $request) {
        $application = new Application;

        $application->name = $request->input('name');
        $application->phone = $request->input('phone');
        $application->email = $request->input('email');
        $application->status = Application::PENDING;

        $process->applications()->save($application);

        foreach($process->fields as $field) {
            $inputField = new ApplicationField;

            $inputField->field_id = $field->id;
            $inputField->value = $request->input('field_'.strval($field->id));

            $application->fields()->save($inputField);
        }

        return $application;
    }

    public function update($request, Application $application) {
        if($request->input('action') == 'complete') {
            $application->status = Application::ACCEPTED;
        }

        if($request->input('action') == 'accept') {
            $application->status = Application::ACCEPTED_FOR_INTERVIEW;
        }

        if($request->input('action') == 'refuse') {
            $application->status = Application::REFUSED;
        }

        $application->save();

        if($application->status == Application::ACCEPTED) {
            $this->checkIfProcessShouldBeClosed($application->process);
        }
    }

    private function checkIfProcessShouldBeClosed(Process $process) {
        if($process->applications()->where('status', Application::ACCEPTED)->count() >= $process->spots) {
            $process->status = Process::FINISHED;
            $process->save();
        }
    }
}