<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use QF\Constants as QFConstants;

class NavBar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public function shouldRender()
    {
        $route = Route::currentRouteName();
        $hideHeaderRoutes = [
            QFConstants::ROUTE_NAME_LOGIN_PAGE,
            // QFConstants::ROUTE_NAME_REGISTER_PAGE,
            QFConstants::ROUTE_NAME_RESET_PASSWORD_PAGE,
            QFConstants::ROUTE_NAME_FORGOT_PASSWORD_PAGE,
            QFConstants::ROUTE_NAME_NOTIFICATION_NOTICE

        ];
        if (in_array($route, $hideHeaderRoutes)){
            return false;
        }
        return true;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}
