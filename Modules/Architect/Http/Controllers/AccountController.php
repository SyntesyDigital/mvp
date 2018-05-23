<?php

namespace Modules\Architect\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

use Modules\Architect\Http\Requests\SaveAccountRequest;

use Auth;
use Session;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('architect::account', [
            'user' => Auth::user()
        ]);
    }

    public function save(SaveAccountRequest $request)
    {
        $user = Auth::user();

        if (! $request->get('id') || $request->get('email') != $user->email) {

            $count = $user
                ->where('email', $request->get('email'))
                ->where('id', '<>', $user->id)
                ->count();

            if ($count > 0) {
                Session::flash('notify_error', 'This email has been taken');
                return redirect(route('account'));
            }
        }

        $data  = [
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => trim($request->get('password')) ? trim(Hash::make($request->get('password'))) : '',
            'image' => $request->get('image'),
        ];

        if ($user->update($data)) {
            Session::flash('notify_success', 'Usuario registrado con sucess');
        } else {
            Session::flash('notify_error', "Occurio un error");
        }

        return redirect(route('account'));
    }
}
