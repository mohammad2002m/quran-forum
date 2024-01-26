<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthenticationController;
use QF\Constants;

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

    Route::post('/attemptLogin',  [AuthenticationController::class, 'attemptLogin']) -> name(Constants::ROUTE_NAME_ATTEMPT_LOGIN);
    Route::get('/attemptLogout', [AuthenticationController::class, 'attemptLogout']) -> name(Constants::ROUTE_NAME_ATTEMPT_LOGOUT);


    Route::get('/', [AnnouncementController::class, 'index'])  -> name(Constants::ROUTE_NAME_HOME_PAGE);

    Route::get('/announcement/create', [AnnouncementController::class, 'create']) -> name(Constants::ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE);
    Route::post('/announcement/store', [AnnouncementController::class, 'store']) -> name(Constants::ROUTE_NAME_STORE_ANNOUNCEMENT);

    Route::get('/register', [ViewController::class, 'register']) -> name(Constants::ROUTE_NAME_REGISTER_PAGE);
    Route::get('/login', [ViewController::class, 'login']) -> name(Constants::ROUTE_NAME_LOGIN_PAGE);

});