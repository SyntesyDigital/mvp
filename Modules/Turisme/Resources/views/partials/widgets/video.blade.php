@php

  $video = null;
  if(isset($field['fields'][0])){
      $video = $field['fields'][0]['value'][0];
  }

@endphp


@if(isset($video))
  @include('turisme::partials.typologies.video',[
    "field" => $video,
    "test" => 1
  ])
@endif
