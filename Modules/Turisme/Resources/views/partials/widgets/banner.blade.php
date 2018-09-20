@php

  $banner = null;
  $crop = 'original';

  if(isset($field['fields'][0])){
    if(isset($field['fields'][0]['value']) && sizeof($field['fields'][0]['value'] > 0)){

      $banner = array_pop($field['fields'][0]['value']);
      $banner = $banner['fields'];

      $url = isset($banner['url']['values']['url'][App::getLocale()]) ? $banner['url']['values']['url'][App::getLocale()] : '' ;
      $title = isset($banner['title']['values'][App::getLocale()]) ? $banner['title']['values'][App::getLocale()] : '' ;
      $text = isset($banner['contingut']['values'][App::getLocale()]) ? $banner['contingut']['values'][App::getLocale()] : '' ;
      $image = isset($banner['imatge-fons']['values']['urls'][$crop]) ? $banner['imatge-fons']['values']['urls'][$crop] : '' ;
    }
  }

@endphp

@if(isset($banner))
<div id="{{$field['settings']['htmlId'] or ''}}"  class="banner banner-text estadistiques {{$field['settings']['htmlClass'] or ''}}" style="background-image:url('{{asset($image)}}')">
  <h3><a href="{{$url}}">{{$title}}</a></h3>
  {!!$text!!}
</div>
@endif
