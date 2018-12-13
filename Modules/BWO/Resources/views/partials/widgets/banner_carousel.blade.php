@if(isset($field['value']))
  <div id="carousel-full" class="carousel slide {{$field['settings']['htmlClass'] or ''}}" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach($field['value'] as $index => $widget)
        <li data-target="#carousel-full" data-slide-to="{{$index}}" class="{{$index == 0 ? 'active' : ''}}"></li>
        @endforeach

      </ol>

      <div class="carousel-inner" role="listbox">

        @foreach($field['value'] as $index => $widget)
          @include('bwo::partials.widgets.'.strtolower($field['widget']),
            [
              "field" => $widget,
              "settings" => $field['settings'],
              "class" => $index == 0 ? 'active' : ''
            ]
          )
        @endforeach

      </div>
      @if(count($field['value']) > 1)
        <a class="left carousel-control" href="#carousel-full" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-full" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
      @endif
  </div>
@endif
