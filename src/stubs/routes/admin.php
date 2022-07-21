<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::group(['as'=>'admin.','middleware' => ['web','role:admin']], function(){

    //Default route for admin
    Route::get('/', function (){return Redirect::route('admin.pages');})->name('index');

    //users
    Route::resource('users', 'Admin\UserController');


    //pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
    Route::get('/pages/{id}', [AdminController::class, 'pagesEdit'])->name('pages.slug');
    Route::post('/pages', [AdminController::class, 'pagesCreate'])->name('page.create');
    Route::put('/pages/{id}', [AdminController::class, 'pagesSave'])->name('page.save');
    Route::delete('/pages', [AdminController::class, 'pagesDelete'])->name('page.delete');

    //menu
    Route::get('/menus', [AdminController::class, 'menus'])->name('menu');
    Route::post('/menus', [AdminController::class, 'menusCreate'])->name('menu.create');
    Route::put('/menus/{id}', [AdminController::class, 'menusSave'])->name('menu.save');

    //seo
    Route::get('/seo', [AdminController::class, 'seo'])->name('seo');

    //settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

});


