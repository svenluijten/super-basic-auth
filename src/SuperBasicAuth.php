<?php

namespace Sven\SuperBasicAuth;

use Closure;
use Illuminate\Http\Request;

class SuperBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            !$this->emptyCredentials($request) &&
            $request->getUser() === config('auth.basic.user') &&
            $request->getPassword() === config('auth.basic.password')
        ) {
            return $next($request);
        }

        return response('Invalid credentials.', 401, [
            'WWW-Authenticate' => 'Basic',
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function emptyCredentials(Request $request): bool
    {
        return $request->getUser() === null && $request->getPassword() === null;
    }
}
