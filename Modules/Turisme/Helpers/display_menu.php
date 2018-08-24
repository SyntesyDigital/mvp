<?php

if (!function_exists('display_menu')) {

    function display_menu($key)
    {
        $cacheKey = sprintf("menu_%s", $key);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $menu = Modules\Architect\Entities\Menu::hasName($key)->first();
        $locale = App::getLocale();

        $html = "<ul>";
        foreach($menu->elements as $element) {
            $values = $element->getFieldValues("link", "link", Modules\Architect\Entities\Language::all());
            $title = (isset($values["title"])) && isset($values["title"][$locale]) ? $values["title"][$locale] : null;

            $url = (isset($values["url"])) && isset($values["url"][$locale]) ? $values["url"][$locale] : null;
            $content = isset($values["content"]) ? $values["content"] : null;

            if($content) {
                $url = $content->getFullSlug();
            }

            $html .= sprintf('<li><a href="%s">%s</a></li>', $url, $title);
        }
        $html .= "</ul>";

        Cache::forever($cacheKey, $html);

        return $html;
    }

}
