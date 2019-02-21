@php

  $fieldValue = isset($field['value']) ? $field['value'] : (isset($field['values']) ? $field['values'] : null);

  $url = isset($fieldValue) && isset($fieldValue['urls']['files']) ? asset($fieldValue['urls']['files']) : null;
  $label = (isset($labelFieldName) && $labelFieldName ? $field['name'] : lang('widgets.download_pdf') );

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
    {{$label}}
  </a>
@endif
@if(!isset($div))
</div>
@endif
