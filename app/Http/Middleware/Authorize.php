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
        QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT => [QFConstants::ACTIVITY_CREATE_ANNOUNCEMENT],
        QFConstants::ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE => [QFConstants::ACTIVITY_CREATE_ANNOUNCEMENT],
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
        QFConstants::ROUTE_NAME_API_SUPERVISORS => [QFConstants::ACTIVITY_API_SUPERVISORS],
        QFConstants::ROUTE_NAME_UNAUTHORIZED => null,
        QFConstants::ROUTE_NAME_ARCHIVED_ANNOUNCEMENTS => null,
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
        QFConstants::ROUTE_NAME_REPORTS_INDEX => [QFConstants::ACTIVITY_REPORTS],
        QFConstants::ROUTE_NAME_API_GET_ANNOUNCEMENTS => null,
        QFConstants::ROUTE_NAME_SHOW_ANNOUNCEMENT => null,
        QFConstants::ROUTE_NAME_API_GET_USERS => [QFConstants::ACTIVITY_API_USERS, QFConstants::ACTIVITY_MANAGE_FORUM],
        QFConstants::ROUTE_NAME_STUDENTS_INDEX => [QFConstants::ACTIVITY_STUDENTS],
        QFConstants::ROUTE_NAME_CHANGE_ROLES => [QFConstants::ACTIVITY_STUDENTS],
        QFConstants::ROUTE_NAME_OPEN_REGISTRATION => [QFConstants::ACTIVITY_MANAGE_FORUM],
    ];

    public function handle(Request $request, Closure $next): Response
    {
        return $this -> basicPremissionAuthoization($request , $next);

        
        // after authorization we shouldn't reach this line
        QFLogger::error("unhandled case in Authorize Middleware", json_encode($request -> all()));
        return redirect() -> route(QFConstants::ROUTE_NAME_UNAUTHORIZED);
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
