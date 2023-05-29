<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessRequest;
use App\Http\Requests\UpdateProcessRequest;
use App\Http\Services\ProcessService;
use App\Models\Department;
use App\Models\Process;

class ProcessController extends Controller
{
    public function __construct(protected ProcessService $processService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('process.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Department $department)
    {
        if($department->type != Department::RECRUITMENT) {
            return redirect()->route('department.index')->with('error', 'Nu poți crea un proces în cadrul unui departament ce nu are ca activitate principală recrutarea.');
        }

        return view('process.create', compact("department"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProcessRequest $request, Department $department)
    {
        if(!auth()->user()->is_admin && !auth()->user()->departments()->where('departments.id', $department->id)->count()) {
            return back()->with('error', 'Nu ești autorizat să deschizi un proces în acest departament');
        }

        $process = $this->processService->store($request, $department);

        return redirect()->route('process.show', compact("process"))->with('success', 'Procesul a fost creat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Process $process)
    {
        if(!auth()->user()->is_admin && !auth()->user()->departments()->where('departments.id', $process->department_id)->count()) {
            return back()->with('error', 'Nu ești autorizat să vizualizezi un proces în acest departament');
        }

        return view('process.show', compact("process"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Process $process)
    {
        if(!auth()->user()->is_admin && !auth()->user()->departments()->where('departments.id', $process->department_id)->count()) {
            return back()->with('error', 'Nu ești autorizat să vizualizezi un proces în acest departament');
        }

        return view('process.edit', compact("process"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProcessRequest $request, Process $process)
    {
        $process->status = Process::CLOSED;
        $process->save();

        return redirect()->route('process.show', ['process' => $process])->with('success', 'Procesul a fost actualizat cu succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Process $process)
    {
        //
    }
}
