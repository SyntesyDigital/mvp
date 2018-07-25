@php
  $linkField = $field['fields'][0];
  $link = "";
  $target = "";
  if(isset($linkField['value']['content'])){
    //is internal
    $content = $linkField['value']['content'];
    $link = route('content.show',[$content->getField('slug')]);
  }
  else {
    //is external
    $target = "_blank";
    $link = isset($linkField['value']['url'][App::getLocale()]) ? $linkField['value']['url'][App::getLocale()] : '';
  }

@endphp

<div>
  <a target="{{$target}}" href="{{$link}}" id="{{$field['settings']['htmlId'] or ''}}" class="btn {{$field['settings']['htmlClass'] or ''}}">
    {{$linkField['value']['title'][App::getLocale()] or ''}}
  </a>
</div>
