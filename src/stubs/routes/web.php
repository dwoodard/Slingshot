<?php

use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Inertia\Inertia;

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

Route::prefix('/admin')->group(__DIR__.'/admin.php');


// login/logout
Route::get( 'login', [\App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class,'login']);

Route::match(['get', 'post'],'logout', [\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

//User
Route::delete('/user', function (){
    Auth::user()->delete();
    Auth::logout();
    return Inertia::location(url('/'));
})->name('current-user.destroy');

//Password
Route::put('/user/password', [\App\Http\Controllers\PasswordController::class, 'update'])
    ->middleware(['auth'])
    ->name('password.update');

// user/profile-information
Route::put('/user/profile-information', [\App\Http\Controllers\ProfileInformationController::class, 'update'])
    ->middleware(['auth'])
    ->name('user-profile-information.update');

//Pages
Route::get('/',  [PageController::class, 'welcome'])->name('home');

Route::get('/dashboard', [PageController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware('auth');

Route::get('/profile', [PageController::class, 'profile'])
    ->name('profile.show')
    ->middleware('auth');

Route::get('/settings', [PageController::class, 'settings'])
    ->name('settings.show')
    ->middleware('auth');


Route::get('/terms-of-service',  [PageController::class, 'termsOfService'])->name('terms.show');
Route::get('/privacy-policy',  [PageController::class, 'privacyPolicy'])->name('policy.show');

Route::get('/{slug}',  [PageController::class, 'page'])->name('page');
