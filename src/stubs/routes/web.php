<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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

Auth::routes();
// logout
Route::match(['get', 'post'],'logout', [\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');


Route::get('/', function () {
    return inertia('Welcome/index',[
        'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');


//Pages
Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
