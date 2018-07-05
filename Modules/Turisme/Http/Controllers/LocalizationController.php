<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class LocalizationController extends Controller
{

    public function index($locale)
    {
        // config('app.locales') gives all supported locales
        if (!in_array($locale, config('app.locales'))) {
            $locale = config('app.fallback_locale');
        }

        // Add locale to the cache key
        $json = \Cache::rememberForever("lang-{$locale}.js", function () use ($locale) {

            $files   = glob(resource_path('lang/' . $locale . '/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });

        $contents = 'window.i18n = ' . json_encode($json, config('app.debug', false) ? JSON_PRETTY_PRINT : 0) . ';';
        $response = \Response::make($contents, 200);
        $response->header('Content-Type', 'application/javascript');

        return $response;
    }

}
