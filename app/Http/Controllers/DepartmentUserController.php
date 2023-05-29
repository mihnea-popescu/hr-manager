<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Services\DepartmentUserService;
use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentUserController extends Controller
{
    public function __construct(protected DepartmentUserService $departmentUserService) {}

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
    public function create()
    {
        $users = User::all();

        $departments = Department::all();

        return view('department-user.create', compact("users", "departments"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        return $this->departmentUserService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(DepartmentUser $departmentUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepartmentUser $departmentUser)
    {
        //
    }

    public function updateManager(DepartmentUser $departmentUser) {
        return $this->departmentUserService->updateManager($departmentUser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepartmentUser $departmentUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentUser $departmentUser)
    {
        if(!auth()->user()->is_admin && !in_array($departmentUser->department_id ,array_keys(auth()->user()->departments()->wherePivot('manager', 1)->pluck('departments.name', 'departments.id')->all()))) {
            return back()->with('error', 'Nu ești autorizat.');
        }

        $departmentUser->delete();

        return back()->with('success', 'Ai șters utilizatorul din acel departament.');
    }
}
