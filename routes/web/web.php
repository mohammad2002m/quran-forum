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
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecitationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\WeekController;
use Illuminate\Support\Facades\Auth;
use QF\Constants as QFConstants;

use function QF\Utilites\getSupervisorStudents;

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
    Route::get('/home', [AnnouncementController::class, 'index'])->name(QFConstants::ROUTE_NAME_HOME_PAGE);

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

    // FIXME: change name to about-us
    Route::get('/about_us', [AboutUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);
    Route::get('/forum_rules', [ForumRules::class, 'index'])->name(QFConstants::ROUTE_NAME_RULES_PAGE);
    Route::get('/contact_us', [ContactUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);


    Route::get('/week/edit', [WeekController::class, 'edit'])->name(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE) -> middleware('auth');
    Route::post('/week/update', [WeekController::class, 'update'])->name(QFConstants::ROUTE_NAME_UPDATE_WEEK) -> middleware('auth');
    Route::post('/week/store', [WeekController::class, 'store'])->name(QFConstants::ROUTE_NAME_STORE_WEEK) -> middleware('auth');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index') -> middleware('auth');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit') -> middleware('auth');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update') -> middleware('auth');
    Route::get('/profile/change/cover-image', [ProfileController::class, 'changeCoverImage'])->name('profile.change.cover.image') -> middleware('auth');
    Route::get('/profile/change/profile-image', [ProfileController::class, 'changeProfileImage'])->name('profile.change.profile.image') -> middleware('auth');


    Route::get('/management/index', function (){
        return view('management.index');
    });
    Route::get('/messages/index', function (){
        return view('messages.index');
    });
    Route::get('/messages/show', function (){
        return view('messages.show');
    });
    Route::get('/update/user/data', function (){
        return view('update-user-data.index');
    });

       
    Route::get('/group/index', [GroupController::class, 'index']) -> middleware('auth');
    Route::post('/group/store', [GroupController::class, 'store']) -> middleware('auth');


    Route::get('/reports/index', [ReportsController::class, 'index']) -> name('reports.index') -> middleware('auth');
    Route::get('api/reports/{weekId}/{gender}', [ReportsController::class, 'getReport']) -> name('reports.report') -> middleware('auth');

    Route::get('/recitation/index', [RecitationController::class, 'index']) -> name('recitation.index') -> middleware('auth');
    Route::post('/recitation/update', [RecitationController::class, 'update']) -> name('recitation.update') -> middleware('auth');

    Route::get('/monitoring/index', [MonitoringController::class, 'index']) -> name('monitoring.index') -> middleware('auth');
    Route::post('/monitoring/update', [MonitoringController::class, 'update']) -> name('monitoring.update') -> middleware('auth');

    Route::get('/api/supervisors', [SearchController::class, 'supervisors']) -> middleware('auth');
    Route::get('/api/recitations/{supervisorId}/{year}', [SearchController::class, 'recitationsBySupervisorAndYear']) -> middleware('auth');
    Route::get('/api/excuses/{supervisorId}/{year}', [SearchController::class, 'excusesBySupervisorAndYear']) -> middleware('auth');
    Route::get('/api/weeks/{year}', [SearchController::class, 'weeksByYear']) -> middleware('auth');
});
