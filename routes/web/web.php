<?php

use App\Http\Controllers\AboutUs;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ForumRules;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\WeekController;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

    Route::get('/logout', [LogoutController::class, 'logout'])->name(QFConstants::ROUTE_NAME_ATTEMPT_LOGOUT) -> middleware('auth');


    Route::get('/', [AnnouncementController::class, 'index'])->name(QFConstants::ROUTE_NAME_HOME_PAGE);

    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name(QFConstants::ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE) -> middleware('auth');
    Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name(QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT) -> middleware('auth');

    Route::get('/announcement/index/archived', [AnnouncementController::class, 'indexArchived'])->name(QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT);

    Route::get('/registration/guide', [RegistrationController::class, 'guide']);

    Route::get('/registration/student', [RegistrationController::class, 'registerStudent']) -> middleware('guest');
    Route::post('/registration/student', [RegistrationController::class, 'registerStudentSubmit']) -> middleware('guest');

    Route::get('/registration/volunteer', [RegistrationController::class, 'registerVolunteer']);
    Route::post('/registration/volunteer', [RegistrationController::class, 'registerVolunteerSubmit']);

    Route::get('/login', [LoginController::class, 'login'])->name(QFConstants::ROUTE_NAME_LOGIN_PAGE) -> middleware('guest');
    Route::post('/login',  [LoginController::class, 'attemptLogin'])->name(QFConstants::ROUTE_NAME_ATTEMPT_LOGIN) -> middleware('guest');
    

    // get reset password with token
    Route::get('/reset_password/{token}', [ResetPasswordController::class, 'resetPassword'])->name(QFConstants::ROUTE_NAME_RESET_PASSWORD_PAGE) -> middleware('guest');
    Route::post('/reset_password', [ResetPasswordController::class, 'resetPasswordSubmit'])->name(QFConstants::ROUTE_NAME_RESET_PASSWORD_SUBMIT) -> middleware('guest');

    Route::get('/forgot_password', [ForgotPasswordController::class, 'forgotPassword'])->name(QFConstants::ROUTE_NAME_FORGOT_PASSWORD_PAGE) -> middleware('guest');
    Route::post('/forgot_password', [ForgotPasswordController::class, 'forgotPasswordSubmit'])->name(QFConstants::ROUTE_NAME_FORGOT_PASSWORD_SUBMIT) -> middleware('guest');


    Route::get('/email/verify', [VerifyEmailController::class, 'verfiyEmailNotice']) -> name(QFConstants::ROUTE_NAME_NOTIFICATION_NOTICE);
 
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])->middleware(['signed'])->name(QFConstants::ROUTE_NAME_VERIFY_EMAIL);
    
    Route::post('/email/verify/resend', [VerifyEmailController::class, 'resendEmailVerification'])->middleware(['throttle:6,1'])->name(QFConstants::ROUTE_NAME_RESEND_VERIFICATION_EMAIL);

    Route::get('/about_us', [AboutUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);
    Route::get('/forum_rules', [ForumRules::class, 'index'])->name(QFConstants::ROUTE_NAME_RULES_PAGE);
    Route::get('/contact_us', [ContactUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);


    Route::get('/week/edit', [WeekController::class, 'edit'])->name(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> middleware('auth');
    Route::post('/week/update', [WeekController::class, 'update'])->name(QFConstants::ROUTE_NAME_UPDATE_WEEK) -> middleware('auth');
    Route::post('/week/store', [WeekController::class, 'store'])->name(QFConstants::ROUTE_NAME_STORE_WEEK) -> middleware('auth');

    Route::get('/profile/index', [ViewController::class, 'profile'])->name('profile.index') -> middleware('auth');


    Route::get('/management/index', function (){
        return view('management.index');
    });
    Route::get('/messages/index', function (){
        return view('messages.index');
    });

    Route::get('/group/index', [GroupController::class, 'index']);
    Route::post('/group/store', [GroupController::class, 'store']);

    Route::get('/search/supervisors/select2', [SearchController::class, 'supervisors']) -> middleware('auth');
});
