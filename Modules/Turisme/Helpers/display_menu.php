<?php

if (!function_exists('get_menu')) {

    function get_menu($key)
    {
        $cacheKey = sprintf("menu_%s", $key);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $menu = Modules\Architect\Entities\Menu::hasName($key)->first();
        if(!isset($menu))
          return null;

        $menuRepository = App::make('Modules\Architect\Repositories\MenuRepository');
        $menuTree = $menuRepository->getDisplayTree($menu);

        //dd($menuTree);

        Cache::forever($cacheKey, $menuTree);

        return $menuTree;
    }
}

if (!function_exists('format_link')) {

    function format_link($menuElement) {

      if(!isset($menuElement["name"][App::getLocale()]) ||
        $menuElement["name"][App::getLocale()] == '')
        return null;

      $target = null;
      $url = "";
      if(isset($menuElement["link"]["url"]) &&
        isset($menuElement["link"]["url"][App::getLocale()])){

        $url = $menuElement["link"]["url"][App::getLocale()];
        $target = "_blank";
      }
      else if(isset($menuElement["link"]["content"])){
        $url = $menuElement["link"]["content"]->getFullSlug();
      }
      else {
        return null;
      }

      $result = [
        "url" => $url,
        "name" => $menuElement["name"][App::getLocale()],
        "class" => isset($menuElement["settings"]["htmlClass"]) ?
          $menuElement["settings"]["htmlClass"] : '',
        "id" => isset($menuElement["settings"]["htmlId"]) ?
          $menuElement["settings"]["htmlId"] : '',
        "target" => $target
      ];

      return $result;
    }
}
