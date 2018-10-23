@php
  $slides = isset($field['value']) && $field['value'] > 0 ? $field['value']:null;
  $first = true;
  $crop = "large";
  $settings = isset($settings) ? $settings : $field['settings'];
  $settings = json_decode(json_encode($settings), true);
  if(isset($settings) && isset($settings['cropsAllowed']) && $settings['cropsAllowed'] != null){
    $crop = $settings['cropsAllowed'];
  }
@endphp

@if($slides)
  <div class="carousel-single-container centered">
  <div id="carousel-single" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      @foreach($slides as $item)

        @php
          $title = isset($item['metadata']['fields']['title'][App::getLocale()]) ? $item['metadata']['fields']['title'][App::getLocale()]['value'] : '';
        @endphp

        <div class="item {{$first?'active':''}}"><img src="{{asset($item['urls'][$crop])}}" alt="{{$item['uploaded_filename']}}" class="center-block">
          @if($title != null && $title != '')
            <div class="carousel-caption">
              <p>{{$title}}</p>
            </div>
          @endif
        </div>
        @php
          $first = false;
        @endphp
      @endforeach

  </div>
  @if(count($slides)>1)
    <a class="left carousel-control" href="#carousel-single" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-single" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
  @endif

</div>
@endif
