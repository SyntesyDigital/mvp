@php
  $settings = isset($settings) ? $settings : $field['settings'];
  $settings = json_decode(json_encode($settings), true);
@endphp
<div id="{{$settings['htmlId'] or ''}}" class="{{$settings['htmlClass'] or ''}}">
  <ul class="list-items">


    @foreach($field['value'] as $index => $widget)
      <li class="col-md-4 col-sm-6 col-xs-12">
      @include('turisme::partials.widgets.'.strtolower($field['widget']),
        [
          "field" => $widget,
          "settings" => $field['settings']
        ]
      )
      </li>
    @endforeach
	</ul>
</div>
