<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

// Requests
use Modules\Architect\Http\Requests\Typology\CreateTypologyRequest;
use Modules\Architect\Jobs\Typology\CreateTypology;

// Jobs
use Modules\Architect\Http\Requests\Typology\UpdateTypologyRequest;
use Modules\Architect\Jobs\Typology\UpdateTypology;

// Models
use Modules\Architect\Entities\Typology;
use App\Models\User;
use App\Models\Role;

class TypologiesController extends Controller
{
    public function index()
    {
        return view('architect::typologies', [
            "typologies" => Typology::all()
        ]);
    }

    public function create()
    {
        return view('architect::typology');
    }

    public function show(Typology $typology)
    {
        return view('architect::typology', [
            'typology' => $typology->load('fields')
        ]);
    }

    public function store(CreateTypologyRequest $request)
    {
        $typology = dispatch_now(CreateTypology::fromRequest($request));

        return $typology ? response()->json([
            'success' => true,
            'typology' => $typology
        ]) : response()->json([
            'success' => false
        ], 500);
    }

    public function update(Typology $typology, UpdateTypologyRequest $request)
    {
        $typology = dispatch_now(UpdateTypology::fromRequest($typology, $request));

        return $typology ? response()->json([
            'success' => true,
            'typology' => $typology
        ]) : response()->json([
            'success' => false
        ], 500);
    }
}
