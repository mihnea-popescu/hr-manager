<?php

namespace App\Http\Services;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\User;

class DepartmentUserService {
    public function store($request) {
        $user = User::find($request->user);
        $department = Department::find($request->department);

        $currentUser = auth()->user();

        if(!$currentUser->is_admin && !in_array($department->id ,array_keys($currentUser->departments()->wherePivot('manager', 1)->pluck('departments.name', 'departments.id')->all()))) {
            return back()->with('error', 'Nu ești autorizat.');
        }

        if($user->departments()->where('departments.id', $department->id)->count()) {
            return back()->with('error', 'Utilizatorul este deja în acel departament.');
        }

        $departmentUser = new DepartmentUser;

        $departmentUser->user_id = $user->id;
        $departmentUser->department_id = $department->id;

        $departmentUser->save();

        return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Utilizatorul a fost adăugat în departament.');
    }

    public function updateManager(DepartmentUser $departmentUser) {
        $departmentUser->manager = $departmentUser->manager ? 0 : 1;
        $departmentUser->save();

        return back()->with('success', 'Utilizatorului i-a fost actualizat rolul de manager.');
    }
}