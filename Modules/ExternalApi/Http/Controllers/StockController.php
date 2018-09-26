<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class StockController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->all();

        if($data) {
            foreach($data as $k => $values) {

                foreach($values as $iso => $value) {
                    $language = Language::byIso($iso)->first();

                    $field = ContentField::where('name', 'LIKE', 'stock.%')
                        ->where('value', $k)
                        ->where('language_id', $language->id)
                        ->first();


                    print_r($k);
                }

                //
                // print_R($field);
            }
        }


        return '';
    }
}
