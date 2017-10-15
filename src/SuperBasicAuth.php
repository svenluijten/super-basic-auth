<?php

namespace Sven\SuperBasicAuth;

use Closure;

class SuperBasicAuth
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
        if ($request->getUser() === config('auth.basic.user') &&
            $request->getPassword() === config('auth.basic.password')
        ) {
            return $next($request);
        }

        return response('Invalid credentials.', 401, [
            'WWW-Authenticate' => 'Basic',
        ]);
    }
}
