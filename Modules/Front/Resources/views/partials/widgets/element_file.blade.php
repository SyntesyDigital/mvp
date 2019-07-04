<div id="{{$field['settings']['htmlId'] or ''}}" class="element-file-container {{$field['settings']['htmlClass'] or ''}}">
  <div class="{{$field['settings']['collapsable']? 'element-collapsable':'' }} element-file-container-head {{$field['settings']['collapsed']?'collapsed':''}}" @if($field['settings']['collapsable']) data-toggle="collapse" data-target="#collapsefile-{{$field['settings']['fileElements']?$field['settings']['fileElements']:''}}" aria-expanded="true" aria-controls="collapsefile-{{$field['settings']['fileElements']?$field['settings']['fileElements']:''}}"@endif>
    {{$field['fields'][0]['value'][App::getLocale()]}}
  </div>
  <div id="collapsefile-{{$field['settings']['fileElements']?$field['settings']['fileElements']:''}}" class=" collapse {{$field['settings']['collapsed']?'':'in'}} element-file-container-body">
      <div id="elementFile" class="elementFile "
        field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
        doubleColumn="{{$field['settings']['doubleColumn']?$field['settings']['doubleColumn']:false}}"
        elementObject="{{$field['settings']['fileElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['fileElements'])->first()->load('fields'))):null}}" >

      </div>
      <div>
        <div class="more-btn">
          @include('front::partials.fields.'.$field['fields'][1]['type'],
            [
              "field" => $field['fields'][1],
              "settings" => $field['settings'],
              "div" => false,
              "icon" => "far fa-eye"

            ]
          )
        </div>
      </div>
  </div>
</div>
