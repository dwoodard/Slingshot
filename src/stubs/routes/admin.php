<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware' => ['auth','checkAdmin']], function(){
    Route::get('/', function () {
        return Redirect::route('admin.dashboard');
    })->name('admin.index');

    Route::get('/dashboard', function () {
        return Inertia('admin/dashboard');
    })->name('admin.dashboard');
});


