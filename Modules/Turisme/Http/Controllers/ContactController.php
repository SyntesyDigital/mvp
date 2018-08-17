<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Turisme\Jobs\Contact\SaveContact;
use Modules\Turisme\Http\Requests\SaveContactRequest;

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


}
