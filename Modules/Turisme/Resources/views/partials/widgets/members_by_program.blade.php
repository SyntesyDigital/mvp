<div id="{{$field['settings']['htmlId'] or ''}}" class="widget list-items {{$field['settings']['htmlClass'] or ''}}">

  <div id="members-by-program"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>

</div>