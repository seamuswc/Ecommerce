<?php

namespace App\Http\Middleware;

use Closure;
use App\user;

class Registered
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

      if (user::count() > 0) {
        return redirect('/');
      }

        return $next($request);
    }
}
