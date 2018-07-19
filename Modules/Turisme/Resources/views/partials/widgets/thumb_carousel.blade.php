<div  id="{{$field['settings']['htmlId'] or ''}}" class="widget slider promo trade {{$field['settings']['htmlClass'] or ''}}">
  <h3>Per què Barcelona?</h3>
  <div id="carousel2" class="carousel slide" data-ride="carousel">

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

    <a class="left carousel-control" href="#carousel2" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel2" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>

  </div>
</div>
