<?php

use App\Http\Controllers\AboutUs;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ApplicationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ForceInformationUpdate;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ForumRules;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecitationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UnauthorizedController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\WeekController;
use Illuminate\Console\Application;
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

    Route::get('/logout', [LogoutController::class, 'logout'])->name(QFConstants::ROUTE_NAME_ATTEMPT_LOGOUT)->middleware('auth');

    Route::get('/', [AnnouncementController::class, 'index'])->name(QFConstants::ROUTE_NAME_HOME_PAGE);
    Route::get('/home', [AnnouncementController::class, 'index'])->name(QFConstants::ROUTE_NAME_HOME_PAGE);

    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name(QFConstants::ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE)->middleware('auth');
    Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name(QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT)->middleware('auth');
    Route::get('/announcement/show/{id}', [AnnouncementController::class, 'show'])->name(QFConstants::ROUTE_NAME_SHOW_ANNOUNCEMENT);
    Route::post('/announcement/delete', [AnnouncementController::class, 'delete'])->name(QFConstants::ROUTE_NAME_DELETE_ANNOUNCEMENT)->middleware('auth');


    Route::get('/registration/guide', [RegistrationController::class, 'guide'])->name(QFConstants::ROUTE_NAME_REGISTRATION_GUIDE);

    Route::get('/registration/student', [RegistrationController::class, 'registerStudent'])->middleware('guest')->name(QFConstants::ROUTE_NAME_STUDNET_REGISTER_PAGE);
    Route::post('/registration/student', [RegistrationController::class, 'registerStudentSubmit'])->middleware('guest')->name(QFConstants::ROUTE_NAME_STUDNET_REGISTER_SUBMIT);

    Route::get('/registration/volunteer', [RegistrationController::class, 'registerVolunteer'])->name(QFConstants::ROUTE_NAME_VOLUNTEER_REGISTER_PAGE);
    Route::post('/registration/volunteer', [RegistrationController::class, 'registerVolunteerSubmit'])->name(QFConstants::ROUTE_NAME_VOLUNTEER_REGISTER_SUBMIT);

    Route::post('/registration/open', [RegistrationController::class, 'openRegistration'])->name(QFConstants::ROUTE_NAME_OPEN_REGISTRATION)->middleware('auth');

    Route::get('/applications/index/supervising', [ApplicationsController::class, 'indexSupervising'])->name(QFConstants::ROUTE_NAME_APPLICATION_INDEX_SUPERVISING)->middleware('auth');
    Route::get('/applications/index/monitoring', [ApplicationsController::class, 'indexMonitoring'])->name(QFConstants::ROUTE_NAME_APPLICATION_INDEX_MONITORING)->middleware('auth');

    Route::get('/exam/supervising/index', [ExamController::class, 'supervisingExam'])->name(QFConstants::ROUTE_NAME_SUPERVISING_EXAM_INDEX)->middleware('auth');
    Route::post('/exam/supervising/mark/update', [ExamController::class, 'updateSupervisingMark'])->name(QFConstants::ROUTE_NAME_SUPERVISING_EXAM_MARK_UPDATE)->middleware('auth');

    Route::get('/image/upload/index', [ImageController::class, 'index'])->name(QFConstants::ROUTE_NAME_IMAGE_UPLOAD_INDEX)->middleware('auth');
    Route::post('/image/upload/store', [ImageController::class, 'store'])->name(QFConstants::ROUTE_NAME_IMAGE_UPLOAD_STORE)->middleware('auth');
    Route::post('/image/delete', [ImageController::class, 'delete'])->name(QFConstants::ROUTE_NAME_IMAGE_DELETE)->middleware('auth');

    Route::get('/login', [LoginController::class, 'login'])->name(QFConstants::ROUTE_NAME_LOGIN_PAGE)->middleware('guest');
    Route::post('/login',  [LoginController::class, 'attemptLogin'])->name(QFConstants::ROUTE_NAME_ATTEMPT_LOGIN)->middleware('guest');


    // get reset password with token
    Route::get('/reset_password/{token}', [ResetPasswordController::class, 'resetPassword'])->name(QFConstants::ROUTE_NAME_RESET_PASSWORD_PAGE)->middleware('guest');
    Route::post('/reset_password', [ResetPasswordController::class, 'resetPasswordSubmit'])->name(QFConstants::ROUTE_NAME_RESET_PASSWORD_SUBMIT)->middleware('guest');

    Route::get('/forgot_password', [ForgotPasswordController::class, 'forgotPassword'])->name(QFConstants::ROUTE_NAME_FORGOT_PASSWORD_PAGE)->middleware('guest');
    Route::post('/forgot_password', [ForgotPasswordController::class, 'forgotPasswordSubmit'])->name(QFConstants::ROUTE_NAME_FORGOT_PASSWORD_SUBMIT)->middleware('guest');


    Route::get('/email/verify', [VerifyEmailController::class, 'verfiyEmailNotice'])->name(QFConstants::ROUTE_NAME_NOTIFICATION_NOTICE);

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])->middleware(['signed'])->name(QFConstants::ROUTE_NAME_VERIFY_EMAIL);

    Route::post('/email/verify/resend', [VerifyEmailController::class, 'resendEmailVerification'])->middleware(['throttle:6,1'])->name(QFConstants::ROUTE_NAME_RESEND_VERIFICATION_EMAIL);

    // FIXME: change name to about-us
    Route::get('/about_us', [AboutUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);
    Route::get('/forum_rules', [ForumRules::class, 'index'])->name(QFConstants::ROUTE_NAME_RULES_PAGE);
    Route::get('/contact_us', [ContactUs::class, 'index'])->name(QFConstants::ROUTE_NAME_ABOUT_PAGE);


    Route::get('/week/edit', [WeekController::class, 'edit'])->name(QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE)->middleware('auth');
    Route::post('/week/update', [WeekController::class, 'update'])->name(QFConstants::ROUTE_NAME_UPDATE_WEEK)->middleware('auth');
    Route::post('/week/store', [WeekController::class, 'store'])->name(QFConstants::ROUTE_NAME_STORE_WEEK)->middleware('auth');

    Route::get('/profile', [ProfileController::class, 'index'])->name(QFConstants::ROUTE_NAME_PROFILE_INDEX)->middleware('auth');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name(QFConstants::ROUTE_NAME_PROFILE_EDIT)->middleware('auth');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name(QFConstants::ROUTE_NAME_PROFILE_UPDATE)->middleware('auth');
    Route::get('/profile/change/cover-image', [ProfileController::class, 'changeCoverImage'])->name(QFConstants::ROUTE_NAME_PROFILE_CHANGE_COVER_IMAGE)->middleware('auth');
    Route::get('/profile/change/profile-image', [ProfileController::class, 'changeProfileImage'])->name(QFConstants::ROUTE_NAME_PROFILE_CHANGE_PROFILE_IMAGE)->middleware('auth');


    Route::get('/management/index', [ManagementController::class, 'index'])->name(QFConstants::ROUTE_NAME_MANAGEMENT_INDEX)->middleware('auth');

    Route::get('/force-information-update', [ForceInformationUpdate::class, 'force'])->name(QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_FORCE)->middleware('auth');
    Route::get('/force-information-update/index', [ForceInformationUpdate::class, 'index'])->name(QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_INDEX)->middleware('auth');
    Route::post('/force-information-update/update', [ForceInformationUpdate::class, 'update'])->name(QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_UPDATE)->middleware('auth');

    Route::get('/messages/index', [MessagesController::class, 'index'])->name(QFConstants::ROUTE_NAME_MESSAGES_INDEX);
    Route::get('/messages/show', [MessagesController::class, 'show'])->name(QFConstants::ROUTE_NAME_MESSAGES_SHOW);

    Route::get('/unauthorized', [UnauthorizedController::class, 'index'])->name(QFConstants::ROUTE_NAME_UNAUTHORIZED);


    Route::get('/group/index', [GroupController::class, 'index'])->name(QFConstants::ROUTE_NAME_GROUP_INDEX)->middleware('auth');
    Route::post('/group/store', [GroupController::class, 'store'])->name(QFConstants::ROUTE_NAME_GROUP_STORE)->middleware('auth');
    Route::post('/group/delete', [GroupController::class, 'delete'])->name(QFConstants::ROUTE_NAME_GROUP_DELETE)->middleware('auth');
    Route::post('/group/update/supervisor', [GroupController::class, 'updateSupervisor'])->name(QFConstants::ROUTE_NAME_GROUP_UPDATE_SUPERVISOR)->middleware('auth');
    Route::post('/group/update/monitor', [GroupController::class, 'updateMonitor'])->name(QFConstants::ROUTE_NAME_GROUP_UPDATE_MONITOR)->middleware('auth');

    Route::post('/group/student/update', [GroupController::class, 'updateStudentGroup'])->name(QFConstants::ROUTE_NAME_UPDATE_STUDENT_GROUP)->middleware('auth');

    Route::get('/reports/index', [ReportsController::class, 'index'])->name(QFConstants::ROUTE_NAME_REPORTS_INDEX)->middleware('auth');

    Route::get('/recitation/index', [RecitationController::class, 'index'])->name(QFConstants::ROUTE_NAME_RECITATION_INDEX)->middleware('auth');
    Route::post('/recitation/update', [RecitationController::class, 'update'])->name(QFConstants::ROUTE_NAME_RECITATION_UPDATE)->middleware('auth');

    Route::get('/monitoring/index', [MonitoringController::class, 'index'])->name(QFConstants::ROUTE_NAME_MONITORING_INDEX)->middleware('auth');
    Route::post('/monitoring/update', [MonitoringController::class, 'update'])->name(QFConstants::ROUTE_NAME_MONITORING_UPDATE)->middleware('auth');

    Route::get('/students/index', [StudentsController::class, 'index'])->name(QFConstants::ROUTE_NAME_STUDENTS_INDEX)->middleware('auth');

    Route::get('/api/supervisors/by-user-gender', [SearchController::class, 'getSupervisors'])->name(QFConstants::ROUTE_NAME_API_SUPERVISORS)->middleware('auth');
    Route::get('/api/monitors/by-user-gender', [SearchController::class, 'getMonitors'])->name(QFConstants::ROUTE_NAME_API_MONITORS)->middleware('auth');
    Route::get('/api/groups/by-user-gender', [SearchController::class, 'getGroups'])->name(QFConstants::ROUTE_NAME_API_GROUPS)->middleware('auth');

    Route::get('/api/recitations/{supervisorId}/{year}', [SearchController::class, 'recitationsBySupervisorAndYear'])->name(QFConstants::ROUTE_NAME_API_RECITATIONS)->middleware('auth');
    Route::get('/api/excuses/{supervisorId}/{year}', [SearchController::class, 'excusesBySupervisorAndYear'])->name(QFConstants::ROUTE_NAME_API_EXECUSES)->middleware('auth');
    Route::get('/api/weeks/{year}', [SearchController::class, 'weeksByYear'])->name(QFConstants::ROUTE_NAME_API_WEEKS)->middleware('auth');
    Route::get('/api/reports/{weekId}/{gender}', [ReportsController::class, 'getReport'])->name(QFConstants::ROUTE_NAME_API_WEEKLY_REPORT)->middleware('auth');
    Route::get('/api/announcements', [SearchController::class, 'getAnnouncements'])->name(QFConstants::ROUTE_NAME_API_GET_ANNOUNCEMENTS);
    Route::get('/api/users', [SearchController::class, 'getUsers'])->name(QFConstants::ROUTE_NAME_API_GET_USERS)->middleware('auth');
    Route::get('/api/announcements/{batch}', [SearchController::class, 'getAnnouncementsBatch'])->name(QFConstants::ROUTE_NAME_API_GET_ANNOUNCEMENTS);

    Route::get('/api/applications/supervising', [ApplicationsController::class, 'getSupervisingApplication'])->name(QFConstants::ROUTE_NAME_API_GET_SUPERVISING_APPLICATIONS) -> middleware('auth');
    Route::get('/api/applications/monitoring', [ApplicationsController::class, 'getMonitoringApplication'])->name(QFConstants::ROUTE_NAME_API_GET_MONITORING_APPLICATIONS) -> middleware('auth');
    Route::get('/api/applications/supervising/pending', [ApplicationsController::class, 'getPendingSupervisingApplication'])->name(QFConstants::ROUTE_NAME_API_GET_SUPERVISING_PENDING_APPLICATIONS) -> middleware('auth');
    // /api/applications/supervising/pending'

    Route::post('/applications/supervising/take-action', [ApplicationsController::class, 'takeActionSupervisingApplication'])->name(QFConstants::ROUTE_NAME_ACTION_SUPERVISING_APPLICATION)->middleware('auth');
    Route::post('/applications/monitoring/take-action', [ApplicationsController::class, 'takeActionMonitoringApplication'])->name(QFConstants::ROUTE_NAME_ACTION_MONITORING_APPLICATION)->middleware('auth');

    // Route::get("action-supervisor-application"

    Route::post('/change-roles', [RoleController::class, 'changeRoles'])->name(QFConstants::ROUTE_NAME_CHANGE_ROLES)->middleware('auth');
});
