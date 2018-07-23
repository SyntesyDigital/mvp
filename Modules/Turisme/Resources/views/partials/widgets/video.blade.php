@php

  $video = null;
  if(isset($field['fields'][0])){
      $video = $field['fields'][0]['value'][0];
  }

@endphp

@if(isset($video))
<div id="{{$field['settings']['htmlId'] or ''}}"  class="banc-media {{$field['settings']['htmlClass'] or ''}}">

  <p class="medias">
    <iframe width="100%" src="https://www.youtube.com/embed/KuBKjsBQJ1o?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
  </p>
  <p class="titol">Lorem ipsum dolor sit amet</p>
  <p class="intro">Mauris sed tristique dui. Proin non odio luctus, tristique diam id, malesuada arcu. </p>
  <p class="detalls"> Durada: 30min.</p>
  <a href="" class="opcions seleccio">Enllaç YouTube</a>

</div>
@endif
