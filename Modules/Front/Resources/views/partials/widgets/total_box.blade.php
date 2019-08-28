<div id="{{$field['settings']['htmlId'] or ''}}" class="total-box-container {{$field['settings']['htmlClass'] or ''}}">
  <div class="title">
      <i class="fa fa-{{$field['fields'][1]['value']['fr']}}"></i>

      @include('front::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => $field['settings'],
          "div" => false,
          "icon" => "fas fa-plus-circle"
        ]
      )
  </div>

  <div class="total-box-container-body">
      <div id="totalBox" class="totalBox"
        elementObject="{{$field['settings']['tableElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['tableElements'])->first()->load('fields'))):null}}"
      >
      </div>
  </div>
</div>
