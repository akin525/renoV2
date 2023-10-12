<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChoosePlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->plan==NULl) {
            // Assuming you have a "choose plan" route named "plan.choose"
            Alert::success('message','Please choose a plan before continuing.');
            return redirect()->route('plan');
        }

        return $next($request);
    }
}
