<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::group(['as'=>'admin.','middleware' => ['web','role:admin']], function(){

    Route::get('/', function (){return Redirect::route('admin.dashboard');})->name('index');

    //dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //users
    Route::resource('users', 'Admin\UserController');


    //pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
    Route::get('/pages/{slug}', [AdminController::class, 'pagesEdit'])->name('pages');
    Route::post('/pages', [AdminController::class, 'pagesCreate'])->name('page.create');
    Route::post('/pages/{slug}', [AdminController::class, 'pagesSave'])->name('page.save');
    Route::delete('/pages', [AdminController::class, 'pagesDelete'])->name('page.delete');

    //settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

});


