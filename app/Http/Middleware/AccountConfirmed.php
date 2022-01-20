<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccountConfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (is_null($user->account_verified_at)) {
            return redirect()->route('backoffice.users.confirm');
        }

        return $next($request);
    }
}
