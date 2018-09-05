<div id="{{$field['settings']['htmlId'] or ''}}" class="widget-blog {{$field['settings']['htmlClass'] or ''}}">
  <div id="blog" class="blog"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    entrevistas="0"
  >
  </div>

</div>
