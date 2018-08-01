<div id="{{$field['settings']['htmlId'] or ''}}" class="widget blog list-items image {{$field['settings']['htmlClass'] or ''}}">
  <h3>
    @include('turisme::partials.fields.'.$field['fields'][0]['type'],
      [
        "field" => $field['fields'][0],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </h3>

  <div id="typology-by-category"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>

</div>
