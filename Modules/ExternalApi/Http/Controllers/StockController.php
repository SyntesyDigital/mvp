<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\ContentField;


class StockController extends Controller
{

    public function update(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $count = 0;

        foreach($data as $k => $v) {
            $field = ContentField::where('name', 'LIKE', 'stock.%.identifier')
                ->where('value', $k)
                ->first();

            if($field) {
                $index = isset(explode('.', $field->name)[1]) ? explode('.', $field->name)[1] : null;

                if($index !== null) {
                    if(ContentField::where('name', 'LIKE', sprintf("stock.%d.value", $index))->update([
                        'value' => $v
                    ])) {
                        $count++;
                    }
                }
            }
        }

        return [
            'success' => true,
            'rows_updated' => $count
        ];

    }
}
