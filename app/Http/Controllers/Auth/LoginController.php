<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Modules\Extranet\Jobs\User\Login;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
        $message = trans('auth.failed');

        try {
            if (dispatch_now(Login::fromRequest($request))) {
                return redirect($this->redirectTo);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $validator = Validator::make($request->all(), []);
        
        if(strpos($message,'500')) {
            $message = Login::MESSAGE_500;
        }
        else {
            $message = Login::MESSAGE_404;
        }

        $validator->errors()->add('server', $message);

        return redirect('login')
                  ->withErrors($validator)
                  ->withInput();
    }

    public function showLoginForm()
    {
        return view('extranet::auth.login');
    }
}
