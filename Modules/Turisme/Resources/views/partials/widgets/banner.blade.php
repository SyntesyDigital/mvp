@php

  $banner = null;
  if(isset($field['fields'][0])){
      $banner = $field['fields'][0]['value'][0];
  }

@endphp

@if(isset($banner))
<div id="{{$field['settings']['htmlId'] or ''}}"  class="banner banner-text estadistiques {{$field['settings']['htmlClass'] or ''}}">
  <h3><a href="#">Estadístiques</a></h3>
  <p>Ut enim ad minim veniam, quis  <br>
    nostrud exercitation ullamco <br>
    minim veniam.
  </p>
</div>
@endif
