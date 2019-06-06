<?php

namespace App\Http\Middleware;

use Closure;

// Role definition in config/roles.php

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $roles = array_map(function($role){
            return constant(trim($role));
        }, $roles);

        if(!has_roles($roles, $request->user())) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
