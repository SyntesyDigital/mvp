<div id="{{$field['settings']['htmlId'] or ''}}"
  class="widget list-items {{$field['settings']['htmlClass'] or ''}} {{$field['settings']['columns'] or ''}}">

  <div id="companies"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>

</div>
