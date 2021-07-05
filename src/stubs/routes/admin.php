<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


//
Route::group(['prefix'=>'admin','as'=>'admin.','middleware' => ['web','admin']], function(){

    Route::get('/', [''])->name('index');

    Route::get('/dashboard', function () {
        return Inertia('admin/dashboard');
    })->name('dashboard');
});


