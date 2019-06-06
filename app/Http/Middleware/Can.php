<?php

namespace App\Http\Middleware;

use Closure;

// Role definition in config/roles.php

class Can
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        // $roles = array_map(function($role){
        //     return constant(trim($role));
        // }, $roles);

        if(!can($permission, $request->user())) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
