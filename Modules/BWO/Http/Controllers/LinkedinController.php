<?php

namespace Modules\BWO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\RRHH\Entities\Offers\Offer;
use Illuminate\Notifications\Messages\MailMessage;

use Socialite;
use App\Model\User;

use League\OAuth2\Client\Provider\LinkedIn;

class LinkedinController extends Controller
{
    public function callback(Request $request)
    {
        $provider = new LinkedIn([
            'clientId' => env('LINKEDIN_KEY'),
            'clientSecret' => env('LINKEDIN_SECRET'),
            'redirectUri' => env('LINKEDIN_REDIRECT_URI'),
        ]);

        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $fields = [
            'id', 'firstName', 'lastName',
        ];

        try {
            $provider = $provider->withFields($fields);

            $member = $provider
                ->withResourceOwnerVersion(2)
                ->getResourceOwner($token);

            $firstname = $member->getFirstname();
            $lastname = $member->getLastname();

            // GET EMAIL
            $request = $provider->getAuthenticatedRequest('GET', 'https://api.linkedin.com/v2/clientAwareMemberHandles?q=members&projection=(elements*(primary,type,handle~))', $token);
            $response = $provider->getParsedResponse($request);
            $email = null;
            if(isset($response["elements"])) {
                foreach($response["elements"] as $element) {
                    if($element["type"] == "EMAIL") {
                        $email = $element["handle~"]["emailAddress"];
                    }
                }
            }

        } catch (Exception $e) {

            // Failed to get user details
            exit('Oh dear...');
        }

        echo 'traitement response linkedin';
        exit();
    }


}
