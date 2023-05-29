<?php

namespace App\Http\Services;

use App\Models\Process;

class ProcessService {
    public function store($request, $department) {
        $process = new Process;
        $process->user_id = auth()->user()->id;

        $process->name = $request->name;
        $process->description = $request->description;
        $process->spots = $request->spots;

        $process->status = Process::IN_WORK;

        $department->processes()->save($process);

        return $process;
    }
}