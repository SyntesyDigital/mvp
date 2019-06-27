{{-- {{dd(\Modules\Extranet\Entities\Element::where('id',$field['settings']['fileElements'])->first())}} --}}
<div id="{{$field['settings']['htmlId'] or ''}}" class="element-file-container {{$field['settings']['htmlClass'] or ''}}">

  <div class="{{$field['settings']['collapsable']? 'element-collapsable':'' }} element-file-container-head" @if($field['settings']['htmlClass']) data-toggle="collapse" data-target="#collapsetable" aria-expanded="true" aria-controls="collapsetable"@endif>
    {{$field['fields'][0]['value'][App::getLocale()]}}
  </div>
  <div id="elementFile" class="elementFile"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    collapsable="{{$field['settings']['collapsable']}}"
    elementObject="{{$field['settings']['fileElements']?base64_encode(json_encode(\Modules\Extranet\Entities\Element::where('id',$field['settings']['fileElements'])->first())):null}}"
    elementFields= "{{$field['settings']['fileElements']?base64_encode(json_encode(Modules\Extranet\Entities\Element::where('id',$field['settings']['fileElements'])->first()->fields()->get())):null}}"
  >
  </div>

</div>
