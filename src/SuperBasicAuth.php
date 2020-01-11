<?php

namespace Sven\SuperBasicAuth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperBasicAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->validate($request)) {
            return $next($request);
        }

        abort(401, 'Invalid credentials.', [
            'WWW-Authenticate' => 'Basic',
        ]);
    }

    protected function validate(Request $request): bool
    {
        return $this->validUser($request->getUser()) && $this->validPassword($request->getPassword());
    }

    protected function validUser(?string $user): bool
    {
        return $user !== null && $user === config('auth.basic.user');
    }

    protected function validPassword(?string $password): bool
    {
        return $password !== null && $password === config('auth.basic.password');
    }
}
