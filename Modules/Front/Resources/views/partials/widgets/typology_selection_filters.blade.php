<div id="{{$field['settings']['htmlId'] or ''}}"
  class="widget-selection list-items {{$field['settings']['htmlClass'] or ''}} {{$field['settings']['columns'] or ''}}">
  <h3>
    @include('front::partials.fields.'.$field['fields'][0]['type'],
      [
        "field" => $field['fields'][0],
        "settings" => $field['settings'],
        "div" => false,
        "p" => false
      ]
    )
  </h3>

  <div id="typology-selection-filters"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>

</div>
