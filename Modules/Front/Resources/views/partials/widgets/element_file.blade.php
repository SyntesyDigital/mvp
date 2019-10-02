@php
  $identifier = str_replace(",","",$field['identifier']);
  $identifier = str_replace("[","",$identifier);
  $identifier = str_replace("]","",$identifier).'_'.$iterator;
@endphp

<div id="{{$field['settings']['htmlId'] or ''}}" class="element-file-container {{$field['settings']['htmlClass'] or ''}}">
  <div class="{{$field['settings']['collapsable']? 'element-collapsable':'' }} element-file-container-head {{$field['settings']['collapsed']?'collapsed':''}}" @if($field['settings']['collapsable']) data-toggle="collapse" data-target="#collapsefile-{{$identifier}}" aria-expanded="true" aria-controls="collapsefile-{{$identifier}}"@endif>
    {{$field['fields'][0]['value'][App::getLocale()]}}
  </div>
  <div id="collapsefile-{{$identifier}}" class=" collapse {{$field['settings']['collapsed']?'':'in'}} element-file-container-body">
      <div id="elementFile" class="elementFile "
        field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
        doubleColumn="{{$field['settings']['doubleColumn']?$field['settings']['doubleColumn']:false}}"
        elementObject="{{$field['settings']['fileElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['fileElements'])->first()->load('fields'))):null}}"
        parameters="{{$parameters}}"
      >

      </div>
      <div>
        <div class="more-btn">
          @include('front::partials.fields.'.$field['fields'][1]['type'],
            [
              "field" => $field['fields'][1],
              "settings" => $field['settings'],
              "div" => false,
              "icon" => "far fa-eye",
              "parameters" => $parameters
            ]
          )
        </div>
      </div>
  </div>
</div>
