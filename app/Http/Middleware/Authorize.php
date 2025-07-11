<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use QF\Constants as QFConstants;
use QFLogger;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // null means that the route is for everyone/guest
    const ROUTE_ACTIVITY_MAPPER = [
        QFConstants::ROUTE_NAME_ATTEMPT_LOGIN => null,
        QFConstants::ROUTE_NAME_ATTEMPT_LOGOUT => null,
        QFConstants::ROUTE_NAME_HOME_PAGE => null,
        QFConstants::ROUTE_NAME_REGISTER_PAGE => null,
        QFConstants::ROUTE_NAME_LOGIN_PAGE => null,
        QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT => [QFConstants::ACTIVITY_MANAGE_ANNOUNCEMENT],
        QFConstants::ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE => [QFConstants::ACTIVITY_MANAGE_ANNOUNCEMENT],
        QFConstants::ROUTE_NAME_DELETE_ANNOUNCEMENT => [QFConstants::ACTIVITY_MANAGE_ANNOUNCEMENT],
        QFConstants::ROUTE_NAME_ABOUT_PAGE => null,
        QFConstants::ROUTE_NAME_RULES_PAGE => null,
        QFConstants::ROUTE_NAME_CONTACTS_US_PAGE => null,
        QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE => [QFConstants::ACTIVITY_MANAGE_WEEKS],
        QFConstants::ROUTE_NAME_UPDATE_WEEK => [QFConstants::ACTIVITY_MANAGE_WEEKS],
        QFConstants::ROUTE_NAME_STORE_WEEK => [QFConstants::ACTIVITY_MANAGE_WEEKS],
        QFConstants::ROUTE_NAME_RESET_PASSWORD_PAGE => null,
        QFConstants::ROUTE_NAME_RESET_PASSWORD_SUBMIT => null,
        QFConstants::ROUTE_NAME_FORGOT_PASSWORD_PAGE => null,
        QFConstants::ROUTE_NAME_FORGOT_PASSWORD_SUBMIT => null,
        QFConstants::ROUTE_NAME_NOTIFICATION_NOTICE => null,
        QFConstants::ROUTE_NAME_VERIFY_EMAIL => null,
        QFConstants::ROUTE_NAME_RESEND_VERIFICATION_EMAIL => null,
        QFConstants::ROUTE_NAME_MONITORING_INDEX => [QFConstants::ACTIVITY_MONITORING],
        QFConstants::ROUTE_NAME_MONITORING_UPDATE => [QFConstants::ACTIVITY_MONITORING],
        QFConstants::ROUTE_NAME_RECITATION_INDEX => [QFConstants::ACTIVITY_RECITATION],
        QFConstants::ROUTE_NAME_RECITATION_UPDATE => [QFConstants::ACTIVITY_RECITATION],
        QFConstants::ROUTE_NAME_MESSAGES_INDEX => null,
        QFConstants::ROUTE_NAME_MESSAGES_SHOW => null,
        QFConstants::ROUTE_NAME_API_WEEKLY_REPORT => [QFConstants::ACTIVITY_REPORTS],
        QFConstants::ROUTE_NAME_API_WEEKS => [QFConstants::ACTIVITY_API_WEEKS, QFConstants::ACTIVITY_MANAGE_WEEKS],
        QFConstants::ROUTE_NAME_API_EXECUSES => [QFConstants::ACTIVITY_API_EXECUSES],
        QFConstants::ROUTE_NAME_API_RECITATIONS => [QFConstants::ACTIVITY_API_RECITATIONS],
        QFConstants::ROUTE_NAME_API_SUPERVISORS => [QFConstants::ACTIVITY_API_SUPERVISORS], /* */
        QFConstants::ROUTE_NAME_API_MONITORS => [QFConstants::ACTIVITY_API_MONITORS],
        QFConstants::ROUTE_NAME_UNAUTHORIZED => null,
        QFConstants::ROUTE_NAME_REGISTRATION_GUIDE => null,
        QFConstants::ROUTE_NAME_STUDNET_REGISTER_PAGE => null,
        QFConstants::ROUTE_NAME_STUDNET_REGISTER_SUBMIT => null,
        QFConstants::ROUTE_NAME_VOLUNTEER_REGISTER_PAGE => null,
        QFConstants::ROUTE_NAME_VOLUNTEER_REGISTER_SUBMIT => null,
        QFConstants::ROUTE_NAME_PROFILE_INDEX => null,
        QFConstants::ROUTE_NAME_PROFILE_EDIT => null,
        QFConstants::ROUTE_NAME_PROFILE_UPDATE => null,
        QFConstants::ROUTE_NAME_PROFILE_CHANGE_COVER_IMAGE => null,
        QFConstants::ROUTE_NAME_PROFILE_CHANGE_PROFILE_IMAGE => null,
        QFConstants::ROUTE_NAME_MANAGEMENT_INDEX => [QFConstants::ACTIVITY_MANAGE_FORUM],
        QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_FORCE => null,
        QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_INDEX => null,
        QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_UPDATE  => null,
        QFConstants::ROUTE_NAME_GROUP_INDEX => [QFConstants::ACTIVITY_MANAGE_GROUPS],
        QFConstants::ROUTE_NAME_GROUP_STORE => [QFConstants::ACTIVITY_MANAGE_GROUPS],
        QFConstants::ROUTE_NAME_GROUP_DELETE => [QFConstants::ACTIVITY_MANAGE_GROUPS],
        QFConstants::ROUTE_NAME_GROUP_UPDATE_MONITOR => [QFConstants::ACTIVITY_MANAGE_GROUPS],
        QFConstants::ROUTE_NAME_GROUP_UPDATE_SUPERVISOR  => [QFConstants::ACTIVITY_MANAGE_GROUPS],
        QFConstants::ROUTE_NAME_API_GROUPS => [QFConstants::ACTIVITY_MANAGE_GROUPS],
        QFConstants::ROUTE_NAME_UPDATE_STUDENT_GROUP => [QFConstants::ACTIVITY_MANAGE_GROUPS],
        QFConstants::ROUTE_NAME_REPORTS_INDEX => [QFConstants::ACTIVITY_REPORTS],
        QFConstants::ROUTE_NAME_API_GET_ANNOUNCEMENTS => null,
        QFConstants::ROUTE_NAME_SHOW_ANNOUNCEMENT => null,

        QFConstants::ROUTE_NAME_API_GET_MEMBERS => [QFConstants::ACTIVITY_USERS],
        QFConstants::ROUTE_NAME_API_GET_FORMERS => [QFConstants::ACTIVITY_USERS],

        QFConstants::ROUTE_NAME_MEMBERS_INDEX => [QFConstants::ACTIVITY_USERS],
        QFConstants::ROUTE_NAME_FORMERS_INDEX => [QFConstants::ACTIVITY_USERS],

        QFConstants::ROUTE_NAME_CHANGE_ROLES => [QFConstants::ACTIVITY_USERS],

        QFConstants::ROUTE_NAME_OPEN_REGISTRATION => [QFConstants::ACTIVITY_MANAGE_FORUM],
        QFConstants::ROUTE_NAME_APPLICATION_INDEX_SUPERVISING => [QFConstants::ACTIVITY_APPLICATIONS],
        QFConstants::ROUTE_NAME_APPLICATION_INDEX_MONITORING => [QFConstants::ACTIVITY_APPLICATIONS],
        QFConstants::ROUTE_NAME_API_GET_SUPERVISING_APPLICATIONS => [QFConstants::ACTIVITY_APPLICATIONS],
        QFConstants::ROUTE_NAME_API_GET_MONITORING_APPLICATIONS => [QFConstants::ACTIVITY_APPLICATIONS],
        QFConstants::ROUTE_NAME_ACTION_SUPERVISING_APPLICATION => [QFConstants::ACTIVITY_APPLICATIONS],
        QFConstants::ROUTE_NAME_ACTION_MONITORING_APPLICATION => [QFConstants::ACTIVITY_APPLICATIONS],

        QFConstants::ROUTE_NAME_SUPERVISING_EXAM_INDEX => [QFConstants::ACTIVITY_SUPERVISING_EXAMS],
        QFConstants::ROUTE_NAME_SUPERVISING_EXAM_MARK_UPDATE=> [QFConstants::ACTIVITY_SUPERVISING_EXAMS],
        QFConstants::ROUTE_NAME_API_GET_SUPERVISING_PENDING_APPLICATIONS => [QFConstants::ACTIVITY_SUPERVISING_EXAMS],

        QFConstants::ROUTE_NAME_IMAGE_UPLOAD_INDEX => [QFConstants::ACTIVITY_UPLOAD_IMAGE],
        QFConstants::ROUTE_NAME_IMAGE_UPLOAD_STORE => [QFConstants::ACTIVITY_UPLOAD_IMAGE],
        QFConstants::ROUTE_NAME_IMAGE_DELETE => [QFConstants::ACTIVITY_UPLOAD_IMAGE],

        QFConstants::ROUTE_NAME_BAN_MEMBER => [QFConstants::ACTIVITY_USERS],
        QFConstants::ROUTE_NAME_RESTORE_FORMER => [QFConstants::ACTIVITY_USERS],
        QFConstants::ROUTE_NAME_CHANGE_STUDENT_STATUS => [QFConstants::ACTIVITY_USERS],
    ];

    public function handle(Request $request, Closure $next): Response
    {
        return $this -> basicPremissionAuthoization($request , $next);
    }

    private function basicPremissionAuthoization(Request $request, Closure $next)
    {
        $routeName = $request -> route() -> getName();
        if (Authorize::ROUTE_ACTIVITY_MAPPER[$routeName] === null){
            return $next($request);
        }

        $user = Auth::user();
        $roles = $user -> roles;

        $allowedUserActivities = [];
        foreach ($roles as $role){
            $rolePermissions = QFConstants::PERMISSIONS[$role -> id];
            $allowedUserActivities = array_merge($allowedUserActivities, $rolePermissions);
        }


        $desiredActivites = Authorize::ROUTE_ACTIVITY_MAPPER[$routeName];
        foreach ($desiredActivites as $desiredActivity){
            if (in_array($desiredActivity, $allowedUserActivities)){
                return $next($request);
            }
        }

        return redirect() -> route(QFConstants::ROUTE_NAME_UNAUTHORIZED);
    }
}
