@php
  $title = isset($field['settings']['title']) && isset($field['settings']['title'][App::getLocale()]) ? $field['settings']['title'][App::getLocale()] : '';
@endphp
@if(isset($field['value']))

  <div id="{{$field['settings']['htmlId'] or ''}}"  class="widget corpo slider list-items banners {{$field['settings']['htmlClass'] or ''}}">
    <h3><a href="#">{{$title}}</a></h3>
    <div id="carousel-multiple2" class="carousel carousel-multiple slide" data-ride="carousel-multiple2">
      <div class="carousel-inner" role="listbox">
        @foreach($field['value'] as $index => $widget)

          @if($index % 4 == 0)
            @if($index != 0)
                </ul>
              </div>
            @endif
          <div class="item @if($index == 0) active @endif">
             <ul>
          @endif

            <li class="col-md-3  col-sm-3 col-xs-12" key="{{$index}}">
            @include('front::partials.widgets.'.strtolower($field['widget']),
              [
                "field" => $widget,
                "settings" => $field['settings'],
                "class" => $index == 0 ? 'active' : ''
              ]
            )
            </li>

        @endforeach

        @if(sizeof($field['value'])-1 % 4 != 0)
          </ul>
        </div>
        @endif

      </div>
      <br>
      @if(count($field['value']) > 1)
        <a class="left carousel-control" href="#carousel-multiple2" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
        <a class="right carousel-control" href="#carousel-multiple2" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
      @endif
    </div>
  </div>
@endif
