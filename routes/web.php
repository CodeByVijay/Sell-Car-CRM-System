<?php

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



Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/Dashboard', function () {
        return view('admin.home');
    })->name('home');

    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');
});

Route::get('/logout', function () {
    return view('auth.login');
})->name('logout');
