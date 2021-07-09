<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


//
Route::group(['as'=>'admin.','middleware' => ['web','role:admin']], function(){

    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('index');

    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/pages', [\App\Http\Controllers\AdminController::class, 'pages'])->name('pages');

});


