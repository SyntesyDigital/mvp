<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\SaveAccountRequest;
use App\Models\User;
use Modules\RRHH\Repositories\UserRepository;
use Auth;
use Hash;
use Session;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.account')->with(compact('user'));
    }

    public function save(SaveAccountRequest $request)
    {
        //$user = $request->get('id') ? $this->users->find($request->get('id')) : new User();

        $user = Auth::user();

        if (! $request->get('id') || $request->get('email') != $user->email) {
            if ($this->users->findWhere([
                'email' => $request->get('email'),
                ['id', '<>', $user->id],
            ])->count() > 0) {
                Session::flash('notify_error', 'This email has been taken');

                return redirect(route('admin.account'));
            }
        }

        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = trim($request->get('password')) ? trim(Hash::make($request->get('password'))) : '';
        $user->image = $request->get('image');

        if ($user->save()) {
            Session::flash('notify_success', 'Utilisateur enregistré avec succès');
        } else {
            Session::flash('notify_error', "Une erreur s'est produite lors de l\'enregistrement");
        }

        return redirect(route('admin.account'));
    }
}
