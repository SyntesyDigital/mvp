@php
  $link = isset($field['fields']['video']['values']['url'][App::getLocale()]) ? $field['fields']['video']['values']['url'][App::getLocale()] : null;
  if($link != null){
    $title = isset($field['fields']['video']['values']['title'][App::getLocale()]) ? $field['fields']['video']['values']['title'][App::getLocale()] : '';
    $description = isset($field['fields']['descripcio']['values'][App::getLocale()]) ? $field['fields']['descripcio']['values'][App::getLocale()] : '';
    $durada = isset($field['fields']['durada']['values'][App::getLocale()]) ? $field['fields']['durada']['values'][App::getLocale()] : '';

    $youtube_id = explode('/',$link);
    $youtube_id = $youtube_id[sizeof($youtube_id)-1];
  }
@endphp

@if(isset($link))

<div class="widget banc-media video">
  <p class="medias">
    <iframe width="100%" src="https://www.youtube.com/embed/{{$youtube_id}}?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
  </p>
  <p class="titol">{{$title}}</p>
  {!!$description!!}
  <p class="detalls"> Durada: {{$durada}}</p>
  <a href="{{$link}}" target="_blank" class="opcions seleccio">Enllaç YouTube</a>
</div>
@endif
