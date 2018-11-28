<?php

namespace Modules\RRHH\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Modules\RRHH\Jobs\SendSignup;
use Modules\RRHH\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function subscribe(Request $request)
    {
        $autoPass = str_random(12);
        $request['password'] = Hash::make($autoPass);
        $request['autopass'] = $autoPass;
        $request['email'] = $request['email_signup'];

        $user = $this->repository->createOnSignup($request->all());

        $this->dispatchNow(SendSignup::fromRequest($request));

        return redirect()
                ->route('home')
                ->with('flash_message', 'Ton inscription à été enregistré.');
    }
}
