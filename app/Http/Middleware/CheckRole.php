<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * @param $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */

    public function handle($request, Closure $next,$role='')
    {

        $userRole = $request->user();

        if(\checkCredential($role))
                return $next($request);
        else
                return abort(401);
    }
}
