<?php

if (!function_exists('display_menu')) {

    function display_menu($key)
    {
        $menu = Modules\Architect\Entities\Menu::hasName($key)->first();
    }

}
