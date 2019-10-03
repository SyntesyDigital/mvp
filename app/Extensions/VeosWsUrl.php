<?php

namespace App\Extensions;

use Auth;

class VeosWsUrl {

    public static function get()
    {
      return self::test();
    }

    public static function prod()
    {
        return env('WS_URL');
    }

    public static function test()
    {
        return env('WS_URL');
    }

    public static function rec()
    {
        return env('WS_URL');
    }

}
