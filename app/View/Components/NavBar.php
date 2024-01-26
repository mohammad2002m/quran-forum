<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

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
        $hideHeaderRoutes = ['login', 'attemptLogin', 'register'];
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
