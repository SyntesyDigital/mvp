@php
  $link = "";
  $target = "";
  if(isset($field['value']['content'])){
    //is internal
    $content = $field['value']['content'];
    $link = route('content.show',[$content->getField('slug')]);
  }
  else {
    //is external
    $target = "_blank";
    $link = isset($field['value']['url'][App::getLocale()]) ? $field['value']['url'][App::getLocale()] : '';
  }

@endphp

@if(!isset($div))
<div>
@endif
  <a target="{{$target}}" href="{{$link}}" id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">
    {{$field['value']['title'][App::getLocale()] or ''}}
  </a>
@if(!isset($div))
</div>
@endif
