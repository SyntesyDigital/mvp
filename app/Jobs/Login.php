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

                    //check if has multiple sessions
                    $isSupervue = isset($user->{'USEREXT.supervue'}) && $user->{'USEREXT.supervue'} == "Y" ? true : false;

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

                    //get new session info depending on the current session
                    $sessionInfo = $this->getSessionInfo($currentSession,$loginResult->token);

                    //Check pages rights
                    //get all pages so store in cache and no need to process again
                    $pages = $this->getPages($loginResult->token);
                    //check if possible to get allowed pages
                    $allowedPages = $this->getAllowedPages(
                      $currentSession,$pages,
                      $loginResult->token,$sessionInfo);

                    $userData = [
                        'id' => isset($user->{'USEREXT.id_per'}) ? $user->{'USEREXT.id_per'} : null,
                        'firstname' => isset($user->{'USEREXT.nom_per'}) ? $user->{'USEREXT.nom_per'} : null,
                        'lastname' => isset($user->{'USEREXT.nom2_per'}) ? $user->{'USEREXT.nom2_per'} : null,
                        'email' => isset($user->{'USEREXT.email_per'}) ? $user->{'USEREXT.email_per'} : null,
                        'phone' => isset($user->{'USEREXT.telprinc_per'}) ? $user->{'USEREXT.telprinc_per'} : null,
                        'supervue' => $isSupervue,
                        'token' => $loginResult->token,
                        'testMode' => $this->testMode,
                        'recMode' => $this->recMode,
                        'role' => $this->processMainRole($sessionInfo),
                        'pages' => $pages,
                        'allowed_pages' => $allowedPages,  //can be null if no session defined
                        'language' => 'fr',
                        'sessions' => $sessions,
                        'session_id' => $currentSession,
                        'session_info' => $sessionInfo
                    ];

                    Session::put('user', json_encode($userData));

                    return true;
                }
            }

        } catch (\Exception $ex) {
            throw $ex;
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

        //get user info
        $result = $client->get($WsUrl . 'boBy/v2/WS_EXT2_USE', [
            'headers' => [
                'Authorization' => "Bearer " . $token
            ]
        ]);

        $userFile = json_decode($result->getBody()->getContents());

        $userInfo = null;
        if($userFile->total > 0 && isset($userFile->data[0])){
          $userInfo = $userFile->data[0];
        }

        return $userInfo;
    }

    private function processMainRole($userext)
    {

        if(!isset($userext)){
          return ROLE_USER;
        }

        //check if user is in admin array
        if(in_array($userext->{'USEREXT.login_per'},Config::get('admin'))){
          //return admin
          return ROLE_SYSTEM;
        }

        if(isset($userext->{'USEREXT.admin'}) && $userext->{'USEREXT.admin'} == "Y"){
          return ROLE_ADMIN;
        }

        return ROLE_USER;
    }

    private function getPages($token)
    {
      $client = new Client();
      $WsUrl = $this->testMode ? VeosWsUrl::test() : VeosWsUrl::prod();

      if($this->recMode) {
          $WsUrl = VeosWsUrl::rec();
      }

      $result = $client->get($WsUrl . 'boBy/v2/WS_EXT2_DEF_PAGES?perPage=100', [
          'headers' => [
              'Authorization' => "Bearer " . $token
          ]
      ]);

      $data = json_decode($result->getBody()->getContents());

      $pages = [];
      if($data->total > 0 && isset($data->data)){
        $pages = $data->data;
      }

      return $pages;
    }

    private function getSessionInfo($currentSession,$token)
    {

      if($currentSession == null)
        return null;

      $client = new Client();
      $WsUrl = $this->testMode ? VeosWsUrl::test() : VeosWsUrl::prod();

      if($this->recMode) {
          $WsUrl = VeosWsUrl::rec();
      }

      $result = $client->get($WsUrl . 'boBy/v2/WS_EXT2_DEF_OPTIONS_SESSION?SES='.$currentSession, [
          'headers' => [
              'Authorization' => "Bearer " . $token
          ]
      ]);


      $data = json_decode($result->getBody()->getContents());



      if($data->total > 0 && isset($data->data[0])){
          return $data->data[0];
      }
      return null;
    }

    /**
    *   Return allowed slugs for this user
    */
    private function getAllowedPages($currentSession,$pages,$token,$sessionInfo)
    {
        if($currentSession == null || $sessionInfo == null){
          //not current session defined so, no pages info yet
          return null;
        }

        $allowedPages = [];

        foreach($pages as $index => $page){
          //if this option exist in user info, and is Y
          if(isset($sessionInfo->{$page->option}) && $sessionInfo->{$page->option} == "Y"){
            //add page
            $allowedPages[$page->PAGE] = true;
          }
          else {
            $allowedPages[$page->PAGE] = false;
          }
        }

        return $allowedPages;
    }

}
