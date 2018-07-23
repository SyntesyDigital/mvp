@php
  $url = isset($field['value']) && isset($field['value']->getUrlsAttribute()['original']) ? asset($field['value']->getUrlsAttribute()['original']) : null;
@endphp
@if(!isset($div))
<div>
@endif
@if(isset($url))
  <a
    id="{{$settings['htmlId'] or ''}}"
    class="{{$settings['htmlClass'] or ''}} {{$class or ''}}"
    href="{{$url}}"
  >
    Descarregar arxiu
  </a>
@endif
@if(!isset($div))
</div>
@endif
