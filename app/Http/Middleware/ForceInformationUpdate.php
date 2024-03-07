<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QF\Constants as QFConstants;
use Symfony\Component\HttpFoundation\Response;

class ForceInformationUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // should be auth
        $user = Auth::user();
        $routeName = $request -> route() -> getName();
        if (Auth::check() &&
            Auth::user() -> force_information_update &&
            $routeName !== QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_PAGE &&
            $routeName !== QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_UPDATE
        ){
            return redirect() -> route(QFConstants::ROUTE_NAME_FORCE_INFORMATION_UPDATE_PAGE);
        }
        return $next($request);
    }
}
