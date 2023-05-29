<?php

use App\Http\Controllers\DepartmentUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function () {
    Route::controller(DepartmentUserController::class)->name('department-user.')->prefix('department-user/{departmentUser}')->group(function () {
        Route::patch('manager', 'updateManager')->name('manager');
    });
});