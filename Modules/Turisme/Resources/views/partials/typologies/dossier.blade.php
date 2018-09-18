@php
  $item = isset($field['fields']) ? $field['fields'] : null;

  if(isset($item)){
    $title = isset($item['title']['values'][App::getLocale()]) ? $item['title']['values'][App::getLocale()] : '' ;
  }
@endphp

<div class="dossier">
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
    @include('turisme::partials.fields.file',[
      "field" => $item['catala'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['espanol'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['japanese'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['english'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['francais'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['italian'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['portuguese'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['arabic'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['czech'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['german'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['chinese'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['russian'],
      "labelFieldName" => true
    ])
    @include('turisme::partials.fields.file',[
      "field" => $item['polish'],
      "labelFieldName" => true
    ])


</div>
