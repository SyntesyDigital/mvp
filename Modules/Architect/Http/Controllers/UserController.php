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
use Modules\Architect\Http\Requests\Users\CreateUserRequest;
use Modules\Architect\Jobs\Users\CreateUser;

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
    {}

    public function show()
    {}

    public function store()
    {}

    public function delete()
    {}
}
