<?php

namespace Sven\SuperBasicAuth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperBasicAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! $this->emptyCredentials($request) &&
            $request->getUser() === config('auth.basic.user') &&
            $request->getPassword() === config('auth.basic.password')
        ) {
            return $next($request);
        }

        return response('Invalid credentials.', 401, [
            'WWW-Authenticate' => 'Basic',
        ]);
    }

    public function emptyCredentials(Request $request): bool
    {
        return $request->getUser() === null && $request->getPassword() === null;
    }
}
