@php
  $item = isset($field['fields']) ? $field['fields'] : null;
  $crop = 'original';
  if(isset($item)){
    $title = isset($item['title']['values'][App::getLocale()]) ? $item['title']['values'][App::getLocale()] : '' ;
    $image = isset($item['imatge']['values']['urls'][$crop]) ? $item['imatge']['values']['urls'][$crop] : '' ;
  }
@endphp

@if(isset($item))
  <div class="widget banc-media buttons">
    <p class="media">
        <img src="{{asset($image)}}" width="315" height="185" alt=""/></p>
        <p class="expand">
          <!--<a href=""><img src="{{asset($image)}}" alt=""/></a>-->
        </p>
        <p class="titol">{{$title}}</p>
        <ul class="detalls">

    <li class="list-forms">
      <label for="Autor">Mides</label>
      <select name="Autor" id="select">
        <option>A3 (42 x 29,7 cm)</option>
        <option>A2 (29,7 x 21 cm)</option>
      </select>
    </li>

    <li class="list-forms">
      <label for="Format">Format</label>
      <select name="Format" id="select2">
        <option>JPG</option>
        <option>PNG</option>
        <option>PDF</option>
      </select>
    </li>

    <li class="list-forms">
      <label for="Ressolucio">Ressolució</label>
      <select name="Ressolucio" id="select3">
        <option>72 dpi</option>
        <option>150 dpi</option>
        <option>300 dpi</option>
      </select>
    </li>
        </ul>
    <button type="button" class="btn ">Descarregar</button>
  </div>
@endif
