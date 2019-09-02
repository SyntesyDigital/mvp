<?php

namespace App\Jobs;


use Illuminate\Validation\ValidationException;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Session;
use Lang;
use Auth;
use Config;

use App\Http\Requests\LoginRequest;

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

    private function getSessions($WsUrl,$token)
    {

      $client = new Client();

      $sessions = $client->get($WsUrl . 'boBy/v2/WS_EXT2_SESSIONS', [
          'headers' => [
              'Authorization' => "Bearer " . $token
          ]
      ]);

      $sessions = json_decode($sessions->getBody());
      return $sessions->data;

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

                    //get user sessions available
                    $sessions = $this->getSessions($WsUrl,$loginResult->token);
                    $currentSession = null;

                    //if no sessions exti
                    if(sizeof($sessions) == 0) {
                      return false;
                    }
                    else if(sizeof($sessions) == 1){
                      //if only one session take this one
                      $currentSession = $sessions[0]->session;
                    }
                    //else need a modal to select from all sessions

                    $userData = [
                        'id' => isset($user->id) ? $user->id : null,
                        'firstname' => isset($user->prenom) ? $user->prenom : null,
                        'lastname' => isset($user->nom) ? $user->nom : null,
                        'email' => isset($user->mail) ? $user->mail : null,
                        'cellphone' => isset($user->mobile) ? $user->mobile : null,
                        'phone' => isset($user->tel) ? $user->tel : null,
                        'token' => $loginResult->token,
                        'testMode' => $this->testMode,
                        'recMode' => $this->recMode,
                        'role' => ROLE_ADMIN,  //TODO set different roles,
                        'language' => 'fr',
                        'sessions' => $sessions,
                        'session_id' => $currentSession
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
