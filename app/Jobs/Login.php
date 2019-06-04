<?php

namespace App\Jobs;


use Illuminate\Validation\ValidationException;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Session;
use Lang;
use Auth;
use Config;

use App\Extensions\VeosWsUrl;

class Login
{

    public function __construct()
    {
        $this->uid = 'MSN';
        $this->passwd = 'MSN';
    }

    public function handle()
    {
        try {
            $client = new Client();

            $WsUrl = VeosWsUrl::test();



            $login = $client->post($WsUrl . 'login', [
                'json' => [
                    'uid' => $this->uid,
                    'passwd' => $this->passwd
                ]
            ]);

            if ($login) {

                $loginResult = json_decode($login->getBody()->getContents());

                Session::put('iga_token', $loginResult->token);

                return true;
            }

        } catch (\Exception $ex) {

            throw ValidationException::withMessages([
                 $ex->getMessage()
             ]);
        }

        return false;
    }

}
