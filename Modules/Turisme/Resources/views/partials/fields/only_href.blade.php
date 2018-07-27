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

<a href="{{$link}}" id="{{$field['settings']['htmlId'] or ''}}">
