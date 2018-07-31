<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfNoSchool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $moreThanOneSchool = optional(Auth::User())->schools() >= 1;

        if (!session('school') && $request->url() !== route('choose-school')) {
            return redirect(route('choose-school'));
        }

        return $response;
    }
}
