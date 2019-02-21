<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use League\OAuth2\Client\Provider\LinkedIn;

use Modules\Extranet\Http\Requests\Candidate\CandidateFrontRequest;
use Modules\Extranet\Jobs\Candidate\RegisterCandidate;
use App\Models\User;
use Session;
use Auth;

class LinkedinController extends Controller
{

    public function __construct()
    {
        $this->linkedinProvider = new LinkedIn([
            'clientId' => env('LINKEDIN_KEY'),
            'clientSecret' => env('LINKEDIN_SECRET'),
            'redirectUri' => env('LINKEDIN_REDIRECT_URI'),
        ]);
    }

    public function login(Request $request)
    {
        return redirect($this->linkedinProvider->getAuthorizationUrl());
    }

    public function callback(Request $request)
    {
        if(!$request->get('code')) {
            return view('front::login');
        }

        $token = $this->linkedinProvider->getAccessToken('authorization_code', [
            'code' => $request->get('code')
        ]);

        // RETRIEVE USER DATA
        $member = $this->linkedinProvider
            ->withFields([
                'id', 'firstName', 'lastName',
            ])
            ->withResourceOwnerVersion(2)
            ->getResourceOwner($token);

        $id = $member->getId();
        $firstname = $member->getFirstname();
        $lastname = $member->getLastname();

        // RETRIEVE USER EMAIL
        $request = $this->linkedinProvider->getAuthenticatedRequest(
            'GET',
            'https://api.linkedin.com/v2/clientAwareMemberHandles?q=members&projection=(elements*(primary,type,handle~))',
            $token
        );
        $response = $this->linkedinProvider->getParsedResponse($request);

        $email = null;
        if(isset($response["elements"])) {
            foreach($response["elements"] as $element) {
                if($element["type"] == "EMAIL") {
                    $email = $element["handle~"]["emailAddress"];
                }
            }
        }

        // IF USER EXIST WE CONNECT-IT AND REDIRECT
        $user = User::where('linkedin_id', $id)->first();

        if($user) {
            Auth::loginUsingId($user->id, true);
            return redirect()->route('home');
        }

        return view('front::login', [
            'linkedin' => [
                'id' => $id,
                'firstname' => isset($firstname['localized']['fr_FR']) ? $firstname['localized']['fr_FR'] : null,
                'lastname' => isset($lastname['localized']['fr_FR']) ? $lastname['localized']['fr_FR'] : null,
                'email' => $email
            ]
        ]);
    }


    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'telephone' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'postal_code' => 'required',
            'location' => 'required',
        ]);

       if ($validator->fails()) {
           return redirect()->route('linkedin.callback')
                       ->withErrors($validator)
                       ->withInput();
       }

        try {
            $this->dispatchNow(new RegisterCandidate($request->all()));
            Session::flash('notify_success', 'Votre compte a été créé avec succès');
            return redirect()->route('home');
        } catch (\Exception $e) {
            Session::flash('notify_error', 'Une erreur s\'est produite lors de la création du compte');
            //$message = $e->getMessage();
        }

        return redirect()->route('linkedin.callback');
    }


}
