@php
  $identifier = str_replace(",","",$field['identifier']);
  $identifier = str_replace("[","",$identifier);
  $identifier = str_replace("]","",$identifier).'_'.$iterator;

  $visible = check_visible($field['settings'],$parameters);
@endphp

@if($visible)
  <div id="{{$field['settings']['htmlId'] or ''}}" class="element-table-container {{$field['settings']['htmlClass'] or ''}}">

    <div class="{{$field['settings']['collapsable']? 'element-collapsable':'' }} element-table-container-head {{$field['settings']['collapsed']?'collapsed':''}}" @if($field['settings']['collapsable']) data-toggle="collapse" data-target="#collapsetable-{{$identifier}}" aria-expanded="true" aria-controls="collapsetable-{{$identifier}}"@endif>
      {{$field['fields'][0]['value'][App::getLocale()]}}
    </div>

    <div id="collapsetable-{{$identifier}}" class=" collapse {{$field['settings']['collapsed']?'':'in'}} element-table-container-body">
        <div id="elementTable" class="elementTable"
          field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
          pagination="{{$field['settings']['pagination'] != null ? true : false }}"
          itemsPerPage="{{$field['settings']['pagination']}}"
          maxItems = "{{$field['settings']['maxItems']}}"
          elementObject="{{$field['settings']['tableElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['tableElements'])->first()->load('fields'))):null}}"
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
@endif
