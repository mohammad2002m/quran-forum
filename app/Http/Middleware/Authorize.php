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
    public function handle(Request $request, Closure $next): Response
    {
        $this -> basic_premission_authoization($request , $next);

        $routeName = $request -> route() -> getName();
        if ($routeName === Constants::ROUTE_NAME_CREATE_ANNOUNCEMENT){
            
        }

        
        // after authorization we shouldn't reach this line
        // I should print to ErrorLog Database Error
        // ErrorLog("unhandled case in Authorize Middleware", "with request for more details")
        return response() -> json([
            'message' => 'Unauthorized'
        ], 401);
    }

    private function basic_premission_authoization(Request $request): bool
    {

        $user = Auth::user();

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