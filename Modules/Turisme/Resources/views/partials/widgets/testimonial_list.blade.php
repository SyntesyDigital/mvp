@php
  $title = isset($field['settings']['title']) && isset($field['settings']['title'][App::getLocale()]) ? $field['settings']['title'][App::getLocale()] : '';
@endphp
@if(isset($field['value']))

  <div id="{{$field['settings']['htmlId'] or ''}}"  class="widget corpo slider list-items banners {{$field['settings']['htmlClass'] or ''}}">
     <h3><a href="#">{{$title}}</a></h3>
     <div id="testimonial" class="carousel testimonial slide" data-ride="testimonial">
       <div class="carousel-inner" role="listbox">
         @foreach($field['value'] as $index => $widget)
           @include('turisme::partials.widgets.'.strtolower($field['widget']),
             [
               "field" => $widget,
               "settings" => $field['settings'],
               "class" => $index == 0 ? 'active' : ''
             ]
           )
         @endforeach
       </div>
       @if(count($field['value']) > 1)
         <a class="left carousel-control" href="#testimonial" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
     		 <a class="right carousel-control" href="#testimonial" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
       @endif
    </div>
  </div>
@endif
