<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Employee\EmployeeController as EmpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// This is Assignment from Angel One Pvt Ltd Andheri

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ********** Admin Routes *********
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'isAdmin']], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    // Employee Routes
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee');
    Route::get('fetch-employee', [EmployeeController::class, 'fetchEmployee'])->name('fetch-employee');
    Route::post('add-employee', [EmployeeController::class, 'addEmployee'])->name('add-employee');
    Route::get('edit-employee', [EmployeeController::class, 'editEmployee'])->name('edit-employee');
    Route::get('view-employee', [EmployeeController::class, 'viewEmployee'])->name('view-employee');
    Route::post('update-employee', [EmployeeController::class, 'updateEmployee'])->name('update-employee');
    Route::post('delete-employee', [EmployeeController::class, 'deleteEmployee'])->name('delete-employee');

    // Client Routes
    Route::get('client', [ClientController::class, 'index'])->name('client');
    Route::get('fetch-client', [ClientController::class, 'fetchClient'])->name('fetch-client');
    Route::post('add-client', [ClientController::class, 'addClient'])->name('add-client');
    Route::get('edit-client', [ClientController::class, 'editClient'])->name('edit-client');
    Route::get('view-client', [ClientController::class, 'viewClient'])->name('view-client');
    Route::post('update-client', [ClientController::class, 'updateClient'])->name('update-client');
    Route::post('delete-client', [ClientController::class, 'deleteClient'])->name('delete-client');

    // Project Routes
    Route::get('project', [ProjectController::class, 'index'])->name('project');
    Route::get('fetch-project', [projectController::class, 'fetchProject'])->name('fetch-project');
    Route::post('add-project', [projectController::class, 'addproject'])->name('add-project');
    Route::get('edit-project', [projectController::class, 'editproject'])->name('edit-project');
    Route::get('view-project', [projectController::class, 'viewproject'])->name('view-project');
    Route::post('update-project', [projectController::class, 'updateproject'])->name('update-project');
    Route::post('delete-project', [projectController::class, 'deleteproject'])->name('delete-project');

    // Tasks Routes
    Route::get('task', [TaskController::class, 'index'])->name('task');
    Route::get('fetch-task', [TaskController::class, 'fetchTask'])->name('fetch-task');
    Route::post('add-task', [TaskController::class, 'addTask'])->name('add-task');
    Route::get('edit-task', [TaskController::class, 'editTask'])->name('edit-task');
    Route::get('view-task', [TaskController::class, 'viewTask'])->name('view-task');
    Route::post('update-task', [TaskController::class, 'updateTask'])->name('update-task');
    Route::post('delete-task', [TaskController::class, 'deleteTask'])->name('delete-task');
});
// ********** Employee Routes *********
Route::group(['prefix' => 'employee', 'middleware' => ['web', 'isEmployee']], function () {
    Route::get('/dashboard', [EmpController::class, 'dashboard'])->name('employee.dashboard');
    // Tasks Routes
    Route::get('task', [EmpController::class, 'index'])->name('emp.task');
    Route::get('fetch-task', [EmpController::class, 'fetchTask'])->name('emp-fetch-task');
    Route::post('add-task', [EmpController::class, 'addTask'])->name('emp-add-task');
    Route::get('edit-task', [EmpController::class, 'editTask'])->name('emp-edit-task');
    Route::get('view-task', [EmpController::class, 'viewTask'])->name('emp-view-task');
    Route::post('update-task', [EmpController::class, 'updateTask'])->name('emp-update-task');
    Route::post('delete-task', [EmpController::class, 'deleteTask'])->name('emp-delete-task');
});
