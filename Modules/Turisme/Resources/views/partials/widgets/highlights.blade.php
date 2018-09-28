@php
  $settings = isset($settings) ? $settings : $field['settings'];
  $settings = json_decode(json_encode($settings), true);
@endphp
<div id="{{$settings['htmlId'] or ''}}"
  class="highlights {{$settings['htmlClass'] or ''}} {{$field['settings']['columns'] or ''}}">
  <ul class="list-items">

    @foreach($field['value'] as $index => $widget)
      <li class="list-item">
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
