<div id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">
  <ul class="list-items">

    @foreach($field['value'] as $index => $widget)
      @include('turisme::partials.widgets.'.strtolower($field['widget']),
        [
          "field" => $widget,
          "settings" => $field['settings']
        ]
      )
    @endforeach
	</ul>
</div>
