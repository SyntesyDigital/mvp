<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Repositories\UserRepository;

// Models
use App\Models\User;
use App\Models\Role;

// Create
use Modules\Architect\Http\Requests\User\CreateUserRequest;
use Modules\Architect\Jobs\User\CreateUser;

// Update
use Modules\Architect\Http\Requests\User\UpdateUserRequest;
use Modules\Architect\Jobs\User\UpdateUser;

// Delete
use Modules\Architect\Http\Requests\User\DeleteUserRequest;
use Modules\Architect\Jobs\User\DeleteUser;


class UserController extends Controller
{

    public function __construct(UserRepository $users) {
        $this->users = $users;
    }

    public function index()
    {
        return view('architect::users.index', [
            "users" => User::all()
        ]);
    }

    public function data()
    {
        return $this->users->getDatatable();
    }

    public function create()
    {
        return view('architect::users.form');
    }

    public function show(User $user)
    {
        return view('architect::users.form', [
            'user' => $user
        ]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        try {
            if(!dispatch_now(UpdateUser::fromRequest($user, $request))) {
                throw new \Exception('Error occured while saving...');
            }

            return redirect(route('users.show', $user))->with('success', 'User successfully saved');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        }

        return redirect(route('users.show', $user))
            ->with('error', $error)
            ->withInput($request->input());
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $user = dispatch_now(CreateUser::fromRequest($request));

            if(!$user) {
                throw new \Exception('Error occured while saving...');
            }

            return redirect(route('users.show', $user))->with('success', 'User successfully saved');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        }

        return redirect(route('users.create'))
            ->with('error', $error)
            ->withInput($request->input());
    }

    public function delete(User $user, DeleteUserRequest $request)
    {
        return dispatch_now(DeleteUser::fromRequest($user, $request)) ? response()->json([
            'success' => true
        ]) : response()->json([
            'success' => false
        ], 500);
    }
}
