<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// sudo chmod o+w ./storage/ -R = Storage Permission command in ububtu.

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/forgot-password', function () {
    return view('auth.forgot_password');
})->name('forgot_password');

Route::get('/reset-password', function () {
    return view('auth.reset_password');
})->name('reset_password');

Route::post('/login',[AuthController::class,'login'])->name('auth.login');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('home');

    Route::get('/valuation/all-leads', function () {
        return view('admin.leads');
    })->name('leads');

    // Get Valuation Data
    Route::post('get-valuation-data',[HomeController::class,'loadData'])->name('loadData');
    // Get Valuation Data End

    Route::get('/employee/add-new-employee', function () {
        return view('admin.addEmp');
    })->name('addEmployee');

    Route::get('/employee/employee-list', [EmployeeController::class,'listAllEmployee'])->name('listAllEmployee');
    Route::post('/employee/add-employee', [EmployeeController::class,'addEditEmployee'])->name('addEditEmployee');
    Route::post('/employee/employee-status', [EmployeeController::class,'employeeStatus'])->name('employeeStatus');
    Route::get('/employee/employee-edit/{id}', [EmployeeController::class,'empEdit'])->name('empEdit');
    Route::get('/employee/employee-delete/{id}', [EmployeeController::class,'empDelete'])->name('empDelete');

    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');
});


Route::name('employee.')->prefix('employee')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('home');

    // Get Valuation Data
    Route::post('get-valuation-data',[HomeController::class,'loadData'])->name('loadData');
    // Get Valuation Data End

    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');
});

Route::get('/logout', [AuthController::class,'logout'])->name('logout');
