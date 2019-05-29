<div  id="{{$field['settings']['htmlId'] or ''}}" class="contact-button {{$field['settings']['htmlClass'] or ''}}">
  <div id="contact-form"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    csrf_token="{{csrf_token()}}"
  >
  </div>
</div>
