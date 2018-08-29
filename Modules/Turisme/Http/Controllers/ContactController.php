<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Turisme\Jobs\Contact\SaveContact;
use Modules\Turisme\Jobs\Contact\SaveContactWithSelection;
use Modules\Turisme\Http\Requests\SaveContactRequest;
use Modules\Turisme\Http\Requests\SaveContactWithSelectionRequest;

class ContactController extends Controller
{
    public function save(SaveContactRequest $request)
    {

      $contact = dispatch_now(SaveContact::fromRequest($request));

      return $contact ? response()->json([
          'success' => true,
          'contact' => $contact
      ]) : response()->json([
          'success' => false
      ], 500);

    }

    public function saveWithSelection(SaveContactWithSelectionRequest $request)
    {

      $contact = dispatch_now(SaveContactWithSelection::fromRequest($request));

      return $contact ? response()->json([
          'success' => true,
          'contact' => $contact
      ]) : response()->json([
          'success' => false
      ], 500);

    }


}
