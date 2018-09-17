@php
  $item = isset($field['fields']) ? $field['fields'] : null;

  if(isset($item)){
    $title = isset($item['title']['values'][App::getLocale()]) ? $item['title']['values'][App::getLocale()] : '' ;
  }
@endphp

<div class="widget banc-media">
  <p class="image">
    @include('turisme::partials.fields.image_object',[
      "field" => $item['image']
    ])
  </p>
  <p class="titol">{{$title}}</p>
  <p class="text">
    @include('turisme::partials.fields.date',[
      "field" => $item['data']
    ])
  </p>
  <p class="text">
    <a href="" >Català</a> |
    <a href="" >Español</a> |
    <a href="" >English</a> |
    <a href="" >Français</a> |
    <a href="" >русский</a> | <a href="" >中国</a>| </p>
</div>
