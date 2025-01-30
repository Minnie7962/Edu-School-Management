<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            session()->flash('error', 'Please log in to access this page.');
            return route('login');
        }
        
        if ($request->expectsJson()) {
            abort(401, 'Unauthenticated');
        }
        
        return null;
    }

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            abort(401, 'Unauthenticated');
        }

        session()->flash('error', 'You do not have permission to access this resource.');
        
        return redirect()->guest(route('login'));
    }
}
