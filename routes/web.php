<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentUserController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('general.index');
    })->name('home');

    Route::resource('department', DepartmentController::class);

    Route::resource('user', UserController::class);

    Route::resource('department-user', DepartmentUserController::class);

    Route::middleware('recruiter')->group(function () {
        Route::get('department/{department}/processes', [DepartmentController::class, 'showProcesses'])->name('department.processes');

        Route::get('department/{department}/processes/create', [ProcessController::class, 'create'])->name('process.create');
        Route::post('department/{department}/processes/store', [ProcessController::class, 'store'])->name('process.store');

        Route::resource('process', ProcessController::class)->except(['create', 'store']);

        // Route::get('application/{application}', [App])

        Route::prefix('application')->name('application.')->controller(ApplicationController::class)->group(function () {
            Route::get('{application}', 'show')->name('show');

            Route::patch('{application}', 'update')->name('update');
        });
    });
});

Route::get('apply/{hash}', [ApplicationController::class, 'create'])->name('application.create');
Route::post('apply/{hash}', [ApplicationController::class, 'store'])->name('application.store');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
