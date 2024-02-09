<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use QF\Constants;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    const ROUTE_AUTHORIZER_MAPPER = [

    ];
    public function handle(Request $request, Closure $next): Response
    {
        $this -> basicPremissionAuthoization($request , $next);


        
        // after authorization we shouldn't reach this line
        // I should print to ErrorLog Database Error
        // ErrorLog("unhandled case in Authorize Middleware", "with request for more details")
        return response() -> json([
            'message' => 'Unauthorized'
        ], 401);
    }

    private function basicPremissionAuthoization(Request $request): bool
    {
        // $user = Auth::user();
        // $roles = $user -> roles;

        // $allowedPermissions = [];
        // foreach ($roles as $role){
        //     $rolePermissions = $role -> permissions;
        // }

        return false;
    }
    private function authorized(Request $request): bool
    {

        return true;
    }

    private function announcement_create_authorization(Request $request): bool
    {
        return true;
    }
    private function announcement_show_authorization(Request $request): bool
    {
        return true;
    }
}
