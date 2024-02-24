<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use QF\Constants as QFConstants;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    /*
    const ROUTE_ACTIVITY_MAPPER = [

        QFConstants::ROUTE_NAME_ATTEMPT_LOGIN => null,
        QFConstants::ROUTE_NAME_ATTEMPT_LOGOUT => null,
        QFConstants::ROUTE_NAME_HOME_PAGE => null,
        QFConstants::ROUTE_NAME_REGISTER_PAGE => null,
        QFConstants::ROUTE_NAME_LOGIN_PAGE => null,
        QFConstants::ROUTE_NAME_STORE_ANNOUNCEMENT => QFConstants::ACTIVITY_CREATE_ANNOUNCEMENT,
        QFConstants::ROUTE_NAME_CREATE_ANNOUNCEMENT_PAGE => QFConstants::ACTIVITY_CREATE_ANNOUNCEMENT,
        QFConstants::ROUTE_NAME_ABOUT_PAGE => null,
        QFConstants::ROUTE_NAME_RULES_PAGE => null,
        QFConstants::ROUTE_NAME_CONTACTS_US_PAGE => null,
        QFConstants::ROUTE_NAME_EDIT_WEEK_PAGE => QFConstants::ACTIVITY_MANAGE_WEEKS,
        QFConstants::ROUTE_NAME_UPDATE_WEEK => QFConstants::ACTIVITY_MANAGE_WEEKS,
        QFConstants::ROUTE_NAME_STORE_WEEK => QFConstants::ACTIVITY_MANAGE_WEEKS,
        
        QFConstants::ROUTE_NAME_RESET_PASSWORD_PAGE => null,
        QFConstants::ROUTE_NAME_RESET_PASSWORD_SUBMIT => null,

        QFConstants::ROUTE_NAME_FORGOT_PASSWORD_PAGE => null,
        QFConstants::ROUTE_NAME_FORGOT_PASSWORD_SUBMIT => null,

        QFConstants::ROUTE_NAME_NOTIFICATION_NOTICE => null,
        QFConstants::ROUTE_NAME_VERIFY_EMAIL => null,
        QFConstants::ROUTE_NAME_RESEND_VERIFICATION_EMAIL => null,
    ];
    */
    public function handle(Request $request, Closure $next): Response
    {
        $this -> basicPremissionAuthoization($request , $next);

        $next($request);
        
        // after authorization we shouldn't reach this line
        // I should print to ErrorLog Database Error
        // ErrorLog("unhandled case in Authorize Middleware", "with request for more details")
        return response() -> json([
            'message' => 'Unauthorized'
        ], 401);
    }

    private function basicPremissionAuthoization(Request $request, Closure $next)
    {
        // Permission is a (role + activity)
        /*
        if (!isset($request -> activity)){
            $next($request);
        }

        $user = Auth::user();
        $roles = $user -> roles;

        $allowedUserActivities = [];
        foreach ($roles as $role){
            $permissions = $role -> permissions;
            foreach ($permissions as $permission){
                $allowedActivity = $permission -> activity;
                array_push($allowedUserActivities, $allowedActivity);
            }
        }

        $allowedUserActivities = array_unique($allowedUserActivities);

        $routeName = $request -> route() -> getName();
        $desiredActivity = Authorize::ROUTE_ACTIVITY_MAPPER[$routeName];

        if (in_array($desiredActivity, $allowedUserActivities)){
            $next($request);
        } else {
        }
        */
    }
}
