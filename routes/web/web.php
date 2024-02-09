<?php

use App\Http\Controllers\AboutUs;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ForumRules;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\WeekController;
use QF\Constants as QFConstants;

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


Route::group([], function () {

    Route::get('/logout', [LogoutController::class, 'logout'])->name(QFConstants::ROUTE_NAME_ATTEMPT_LOGOUT);


    Route::get('/', [AnnouncementController::class, 'index'])->name(QFConstants::ROUTE_NAME_HOME_PAGE);

    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name(QFConstants::ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE);
    Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name(QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT);
    Route::get('/announcement/index/archived', [AnnouncementController::class, 'indexArchived'])->name(QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT);

    Route::get('/registration/guide', [RegistrationController::class, 'guide']);
    Route::get('/registration/student', [RegistrationController::class, 'registerStudent']);
    Route::get('/registration/volunteer', [RegistrationController::class, 'registerVolunteer']);

    Route::post('/registration/student', [RegistrationController::class, 'registerStudentSubmit']);
    Route::post('/registration/volunteer', [RegistrationController::class, 'registerVolunteerSubmit']);

    Route::get('/login', [LoginController::class, 'login'])->name(QFConstants::ROUTE_NAME_LOGIN_PAGE);
    Route::post('/login',  [LoginController::class, 'attemptLogin'])->name(QFConstants::ROUTE_NAME_ATTEMPT_LOGIN);


    // get reset password with token
    Route::get('/reset_password/{token}', [ResetPasswordController::class, 'resetPassword'])->name(QFConstants::ROUTE_NAME_RESET_PASSWORD_PAGE);
    Route::post('/reset_password', [ResetPasswordController::class, 'resetPasswordSubmit'])->name(QFConstants::ROUTE_NAME_RESET_PASSWORD_SUBMIT);

    Route::get('/forgot_password', [ForgotPasswordController::class, 'forgotPassword'])->name(QFConstants::ROUTE_NAME_FORGOT_PASSWORD_PAGE);
    Route::post('/forgot_password', [ForgotPasswordController::class, 'forgotPasswordSubmit'])->name(QFConstants::ROUTE_NAME_FORGOT_PASSWORD_SUBMIT);

    Route::get('/about_us', [AboutUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);
    Route::get('/forum_rules', [ForumRules::class, 'index'])->name(QFConstants::ROUTE_NAME_RULES_PAGE);
    Route::get('/contact_us', [ContactUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);


    Route::get('/week/edit', [WeekController::class, 'edit'])->name(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE);
    Route::post('/week/update', [WeekController::class, 'update'])->name(QFConstants::ROUTE_NAME_UPDATE_WEEK);
    Route::post('/week/store', [WeekController::class, 'store'])->name(QFConstants::ROUTE_NAME_STORE_WEEK);

    Route::get('profile/index', [ViewController::class, 'profile'])->name('profile.index');
});
