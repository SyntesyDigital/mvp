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

    private $login;
    private $password;
    private $testMode;
    private $recMode;

    public function __construct($login, $password)
    {
        $this->uid = $login;
        $this->passwd = $password;
        $this->testMode = substr(strtolower($this->uid), -4) == '-dev' ? true : false;
        $this->recMode = substr(strtolower($this->uid), -4) == '-rec' ? true : false;

        if($this->testMode || $this->recMode) {
            $this->uid = substr($this->uid, 0, -4);
        }
    }

    public static function fromRequest(LoginRequest $request)
    {
        return new Login(
            $request->get('uid'),
            $request->get('passwd')
        );
    }

    public static function fromAttributes($uid,$passwd)
    {
        return new Login(
            $uid,
            $passwd
        );
    }

    public function handle()
    {
        try {
            $client = new Client();

            $WsUrl = $this->testMode ? VeosWsUrl::test() : VeosWsUrl::prod();

            if($this->recMode) {
                $WsUrl = VeosWsUrl::rec();
            }

            $login = $client->post($WsUrl . 'login', [
                'json' => [
                    'uid' => $this->uid,
                    'passwd' => $this->passwd
                ]
            ]);

            if ($login) {

                $loginResult = json_decode($login->getBody()->getContents());

                if(!$loginResult) {
                    return false;
                }

                if ($loginResult->statusCode == 0) {
                    $user = $this->getUser($loginResult->token);
                    $user->testMode = $this->testMode;
                    $user->recMode = $this->recMode;

                    if (!$user) {
                        return false;
                    }

                    $userData = [
                        'id' => isset($user->id) ? $user->id : null,
                        'firstname' => isset($user->prenom) ? $user->prenom : null,
                        'lastname' => isset($user->nom) ? $user->nom : null,
                        'email' => isset($user->mail) ? $user->mail : null,
                        'cellphone' => isset($user->mobile) ? $user->mobile : null,
                        'phone' => isset($user->tel) ? $user->tel : null,
                        'token' => $loginResult->token,
                        'testMode' => $this->testMode,
                        'recMode' => $this->recMode
                    ];

                    Session::put('user', json_encode($userData));

                    return true;
                }
            }

        } catch (\Exception $ex) {

            throw ValidationException::withMessages([
                 $ex->getMessage()
             ]);
        }

        return false;
    }

    public function getUser($token)
    {
        $client = new Client();
        $WsUrl = $this->testMode ? VeosWsUrl::test() : VeosWsUrl::prod();

        if($this->recMode) {
            $WsUrl = VeosWsUrl::rec();
        }

        $result = $client->get($WsUrl . 'personne', [
            'headers' => [
                'Authorization' => "Bearer " . $token
            ]
        ]);

        return json_decode($result->getBody()->getContents());
    }

}
