<?php

use App\Http\Controllers\AboutUs;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\ForumRules;
use App\Http\Controllers\WeekController;
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
    

    Route::get('/about_us', [AboutUs::class, 'index']) -> name(Constants::ROUTE_NAME_ABOUT_PAGE);
    Route::get('/forum_rules', [ForumRules::class, 'index']) -> name(Constants::ROUTE_NAME_RULES_PAGE);
    Route::get('/contact_us', [ContactUs::class, 'index']) -> name(Constants::ROUTE_NAME_ABOUT_PAGE);


    Route::get('/week/edit', [WeekController::class, 'edit']) -> name(Constants::ROUTE_NAME_EDIT_WEEK_PAGE);
    Route::post('/week/update', [WeekController::class, 'update']) -> name(Constants::ROUTE_NAME_UPDATE_WEEK);
    Route::post('/week/store', [WeekController::class, 'store']) -> name(Constants::ROUTE_NAME_STORE_WEEK);

});