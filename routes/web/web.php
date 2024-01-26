<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group([], function() {

    Route::post('/attemptLogin',  [AuthenticationController::class, 'attemptLogin']) -> name('attempt-login');
    Route::get('/attemptLogout', [AuthenticationController::class, 'attemptLogout']) -> name('attempt-logout');


    Route::get('/', [AnnouncementController::class, 'index'])  -> name('home');

    Route::get('/announcement/create', [AnnouncementController::class, 'create']) -> name('create-announcement');
    Route::post('/announcement/store', [AnnouncementController::class, 'store']) -> name('store-announcement');

    Route::get('/register', [ViewController::class, 'register']) -> name('register');
    Route::get('/login', [ViewController::class, 'login']) -> name('login');

});

Route::group(['authenticate', 'authorize'], function() {


});