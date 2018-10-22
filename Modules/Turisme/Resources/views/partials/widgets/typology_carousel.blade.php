<div id="{{$field['settings']['htmlId'] or ''}}" class="widget slider {{$field['settings']['htmlClass'] or ''}}">
  <h3>
    @include('turisme::partials.fields.'.$field['fields'][0]['type'],
      [
        "field" => $field['fields'][0],
        "settings" => $field['settings'],
        "div" => false,
        "p" => false
      ]
    )
  </h3>

  <div id="typology-carousel"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>

</div>
