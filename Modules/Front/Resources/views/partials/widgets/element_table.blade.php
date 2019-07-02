<div id="{{$field['settings']['htmlId'] or ''}}" class="element-table-container {{$field['settings']['htmlClass'] or ''}}">
  <div class="{{$field['settings']['collapsable']? 'element-collapsable':'' }} element-table-container-head {{$field['settings']['collapsed']?'collapsed':''}}" @if($field['settings']['collapsable']) data-toggle="collapse" data-target="#collapsetable-{{$field['settings']['tableElements']?$field['settings']['tableElements']:''}}" aria-expanded="true" aria-controls="collapsetable-{{$field['settings']['tableElements']?$field['settings']['tableElements']:''}}"@endif>
    {{$field['fields'][0]['value'][App::getLocale()]}}
  </div>
  <div id="collapsetable-{{$field['settings']['tableElements']?$field['settings']['tableElements']:''}}" class=" collapse {{$field['settings']['collapsed']?'':'in'}} element-table-container-body">
      <div id="elementTable" class="elementTable "
        field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
        collapsable="{{$field['settings']['collapsable']}}"
        elementObject="{{$field['settings']['tableElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['tableElements'])->first()->load('fields'))):null}}"
      >
      </div>
      <div>
        <!--div class="more-btn">
          @include('front::partials.fields.'.$field['fields'][1]['type'],
            [
              "field" => $field['fields'][1],
              "settings" => $field['settings'],
              "div" => false
            ]
          )
        </div-->
      <div>
  </div>
</div>
