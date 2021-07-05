<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


//
Route::group(['as'=>'admin.','middleware' => ['web','role:admin']], function(){

    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('index');

    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

});


