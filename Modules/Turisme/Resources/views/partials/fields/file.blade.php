@php
  $url = isset($field['value']) && isset($field['value']->getUrlsAttribute()['files']) ? asset($field['value']->getUrlsAttribute()['files']) : null;
@endphp
@if(!isset($div))
<div>
@endif
@if(isset($url))
  <a
    id="{{$settings['htmlId'] or ''}}"
    class="{{$settings['htmlClass'] or ''}} {{$class or ''}}"
    target="_blank"
    href="{{$url}}"
  >
    Descarregar arxiu
  </a>
@endif
@if(!isset($div))
</div>
@endif
