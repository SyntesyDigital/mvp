<div id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">
  <ul class="list-items">

      @foreach($field['value'] as $item)

        @include('turisme::partials.typologies.'.strtolower($item['typology']['identifier']),
          [
            "field" => $item,
            "settings" => $field['settings']
          ]
        )

      @endforeach
	</ul>
</div>
