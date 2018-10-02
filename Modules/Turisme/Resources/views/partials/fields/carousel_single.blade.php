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


<div class="col-md-9 col-sm-10 col-xs-12 centered">
  <div id="carousel-single" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      @foreach($slides as $item)
        <div class="item {{$first?'active':''}}"><img src="{{asset($item['urls'][$crop])}}" alt="{{$item['uploaded_filename']}}" class="center-block">
          <!--div class="carousel-caption">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut dapibus est.tetur adipiscing elit. Donec ut dapibus est. </p>
          </div-->
        </div>
        @php
          $first = false;
        @endphp
      @endforeach

  </div>
  <a class="left carousel-control" href="#carousel-single" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-single" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
</div>
