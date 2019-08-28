<div id="{{$field['settings']['htmlId'] or ''}}" class="total-box-container {{$field['settings']['htmlClass'] or ''}}">
  <div class="title">
      <i class="{{$field['fields'][1]['value'][App::getLocale()]}}"></i>

      {{$field['fields'][0]['value'][App::getLocale()]}}
  </div>

  <div class="total-box-container-body">
      <div id="totalBox" class="totalBox"
        elementObject="{{$field['settings']['tableElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['tableElements'])->first()->load('fields'))):null}}"
      >
      </div>
  </div>
</div>
