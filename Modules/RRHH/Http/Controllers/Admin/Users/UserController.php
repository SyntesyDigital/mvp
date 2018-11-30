<?php

namespace Modules\RRHH\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\User\UserRequest;
use Modules\RRHH\Jobs\User\CreateUser;
use Modules\RRHH\Jobs\User\DeleteUser;
use Modules\RRHH\Jobs\User\UpdateUser;
use App\Models\User;
use Modules\RRHH\Repositories\UserRepository;
use Datatables;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index(Request $request)
    {
        return view('admin.users.index', [
            'users' => $this->users->getAllByRoles(['admin', 'recruiter']),
        ]);
    }

    public function data(Request $request)
    {
        return Datatables::of($this->users->getAllByRoles(['admin', 'recruiter']))

                ->filterColumn('lastname', function ($query, $keyword) {
                    if ($keyword) {
                        $query->whereRaw("CONCAT(users.firstname,' ',users.lastname) like ?", ["%$keyword%"]);
                    }
                })
                ->filterColumn('firstname', function ($query, $keyword) {
                    if ($keyword) {
                        $query->whereRaw("CONCAT(users.firstname,' ',users.lastname) like ?", ["%$keyword%"]);
                    }
                })
               ->addColumn('lastname', function ($item) {
                   return $item->lastname;
               })
               ->addColumn('firstname', function ($item) {
                   return $item->firstname;
               })
               ->addColumn('role', function ($item) {
                   return $item->getRoleName();
               })
               ->addColumn('status', function ($item) {
                   return $item->getStringStatus();
               })
               ->addColumn('action', function ($item) {
                   return '<a href="'.route('admin.users.show', $item).'" class="btn btn-sm btn-success pull-right">Modifier</a>';
               })
           ->make(true);
    }

    public function create(Request $request)
    {
        return view('admin.users.form');
    }

    public function store(UserRequest $request)
    {
        try {
            $user = $this->dispatchNow(CreateUser::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('admin.users.show', $user);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.users.create')->withInput($request->toArray());
    }

    public function show(User $user)
    {
        return view('admin.users.form', [
            'user' => $user,
        ]);
    }

    public function update(User $user, UserRequest $request)
    {
        try {
            $this->dispatchNow(UpdateUser::fromRequest($user, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.users.show', $user);
    }

    public function delete(User $user)
    {
        try {
            $this->dispatchNow(new DeleteUser($user));
            Session::flash('notify_success', 'Suppression effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.users.index');
    }
}
