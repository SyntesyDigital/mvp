<?php

namespace App\Extensions;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

use Session;

class VeosUserProvider implements UserProvider {

    public function __construct()
    {

       if($this->user()) {

           switch($this->user()->role) {
               case ROLE_ADMIN:
               case ROLE_AUTHOR:
               case ROLE_EDITOR:
                    break;

                default:
                    header("Location: /unavailable");
                    exit();
                    break;
           }
       }
    }


    public function retrieveById($identifier)
    {
        //Needs Implementation
        echo 'retrieveById';
        exit();
    }

    public function retrieveByToken($identifier, $token)
    {
        //Needs Implementation
        echo 'retrieveByToken';
        exit();
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
              //Needs Implementation
    }

    public function retrieveByCredentials(array $credentials)
    {
        echo 'retrieveByCredentials';
        exit();
                //Needs Implementation
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        echo 'validateCredentials';
        exit();
              //Needs Implementation
    }

    public function check()
    {
        return Session::has('user') ? true : false;
    }

    public function guest()
    {

    }

    public function user()
    {
        return Session::has('user') ? json_decode(Session::get('user')) : false;
    }

    public function attempt()
    {}

}
