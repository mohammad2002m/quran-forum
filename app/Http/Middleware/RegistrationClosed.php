<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;
use QF\Constants;
use Symfony\Component\HttpFoundation\Response;

class RegistrationClosed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $routeName = $request -> route() -> getName();
        if ($routeName !== Constants::ROUTE_NAME_STUDNET_REGISTER_PAGE
         && $routeName !== Constants::ROUTE_NAME_STUDNET_REGISTER_SUBMIT){
            return $next($request);
        }
        
        $registrationAllowed = intval(Settings::get('registration_allowed_number'));
        if ($registrationAllowed === 0){
            return redirect() -> route(Constants::ROUTE_NAME_REGISTRATION_GUIDE) -> with('error', 'التسجيل مغلق حالياً');
        }

        return $next($request);
    }
}
