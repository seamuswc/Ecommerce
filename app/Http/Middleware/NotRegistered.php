<?php

namespace App\Http\Middleware;

use Closure;
use App\user;

class NotRegistered
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

      if (user::count() <= 0) {
        return redirect('/register');
      }

        return $next($request);
    }
}
