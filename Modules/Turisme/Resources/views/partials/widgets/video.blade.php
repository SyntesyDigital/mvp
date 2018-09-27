@php

  $video = null;

  if(isset($field['fields'][0]) && isset($field['fields'][0]['value']) && sizeof($field['fields'][0]['value']) > 0){
      $video = array_pop($field['fields'][0]['value']);
  }

@endphp


@if(isset($video))
  @include('turisme::partials.typologies.video',[
    "field" => $video,
    "settings" => $field['settings']
  ])
@endif
