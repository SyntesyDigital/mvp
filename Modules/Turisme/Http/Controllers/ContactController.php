<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Turisme\Jobs\Contact\SaveContact;
use Modules\Turisme\Jobs\Contact\SaveContactWithSelection;
use Modules\Turisme\Jobs\Contact\SaveNewsletter;
use Modules\Turisme\Jobs\Contact\SavePress;

use Modules\Turisme\Http\Requests\SaveContactRequest;
use Modules\Turisme\Http\Requests\SaveContactWithSelectionRequest;
use Modules\Turisme\Http\Requests\SaveNewsletterRequest;
use Modules\Turisme\Http\Requests\SavePressRequest;


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

    public function saveNewsletter(SaveNewsletterRequest $request)
    {

      $contact = dispatch_now(SaveNewsletter::fromRequest($request));

      return $contact ? response()->json([
          'success' => true,
          'contact' => $contact
      ]) : response()->json([
          'success' => false
      ], 500);

    }

    public function savePress(SavePressRequest $request)
    {

      $contact = dispatch_now(SavePress::fromRequest($request));

      return $contact ? response()->json([
          'success' => true,
          'contact' => $contact
      ]) : response()->json([
          'success' => false
      ], 500);

    }

    public function downloadFile(Request $request, $id){

      //id : 140-4-1234123434
      //{content_id}-{typology}-{config}-{timestamp}
      $idArray = explode('-',$id);
      $contentId = $idArray[0];
      $typology = $idArray[1];
      $timestamp = $idArray[sizeof($idArray)-1];

      $now = time();
      $diff = $now - $timestamp;

      if($diff > 86400 * 2){ //two days
          abort(404);
      }

      $pathToFile = "";
      $root = realpath($_SERVER["DOCUMENT_ROOT"]);

      if($typology == 7){ //cartografia

        $format = $idArray[2];
        $resolution = $idArray[3];
        $size = $idArray[4];
        $pathToFile = $root."/downloads/7/".$contentId."-".$format."-".$resolution."-".$size.".zip";
      }
      else if($typology == 14){ //logos
        $pathToFile = $root."/downloads/14/".$contentId.".zip";
      }

      if($pathToFile == "")
        abort(404);

      return response()->download($pathToFile);

    }


}
