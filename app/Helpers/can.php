<?php

// Role definition in config/roles.php

if (!function_exists('can')) {
    function can($perm, $user = null)
    {
        $user = $user ?: Auth::user();
        $roles = config('roles');

        $role = array_search($user->role, $roles) ? array_search($user->role, $roles) : "default";

        return config("permissions.$role.$perm");
    }
}
