<?php

namespace App\Extensions;

use Auth;

class VeosWsUrl {

    const PROD = 'prod';
    const DEV = 'dev';
    const REC = 'rec';

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
        return env('WS_URL_TEST');
    }

    public static function rec()
    {
        return env('WS_URL_REC');
    }

    public static function getEnvironmentUrl($env)
    {
      switch($env) {
        case self::DEV :
          return self::test();
          break;
        case self::REC :
          return self::rec();
          break;
        default :
          return self::prod();
          break;
      }
    }

    public static function getEnvironmentOptions()
    {
        return [
          self::DEV,
          self::REC
          //self::PROD
        ];
    }

}
