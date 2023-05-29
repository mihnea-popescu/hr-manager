<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Services\ApplicationService;
use App\Models\Application;
use App\Models\Process;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct(protected ApplicationService $applicationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($hash)
    {
        $process = Process::where('hash', $hash)->first();

        if(!$process) {
            abort(404);
        }

        if($process->status == Process::CLOSED) {
            return view('application.inactive', compact("process"));
        }

        if($process->status != Process::ACCEPTING_APPLICATIONS) {
            abort(404);
        }

        $process->load('fields');

        return view('application.create', compact("process"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($hash, StoreApplicationRequest $request)
    {
        $process = Process::where('hash', $hash)->first();

        if(!$process) {
            abort(404);
        }

        if($process->status == Process::CLOSED) {
            return view('application.inactive', compact("process"));
        }

        if($process->status != Process::ACCEPTING_APPLICATIONS) {
            abort(404);
        }

        $this->applicationService->store($process, $request);

        return view('application.success', compact("process"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $application->load(['fields', 'process' => ['fields']]);

        $fields = $application->fields;

        $process = $application->process;

        $processFields = $application->process->fields;

        return view('application.show', compact("application", "fields", "process", "processFields"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([
            'action' => ['required', 'in:accept,refuse,complete'],
        ]);

        $this->applicationService->update($request, $application);

        return back()->with('success', 'Statusul aplicației a fost actualizat.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
