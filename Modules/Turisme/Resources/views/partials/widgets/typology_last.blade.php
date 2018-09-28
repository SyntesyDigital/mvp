<div id="{{$field['settings']['htmlId'] or ''}}"
  class="widget list-items image {{$field['settings']['htmlClass'] or ''}} {{$field['settings']['columns'] or ''}}">
  <h3>
    @include('turisme::partials.fields.'.$field['fields'][0]['type'],
      [
        "field" => $field['fields'][0],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </h3>

  <div id="typology-last"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>

  <p class="button">
    @include('turisme::partials.fields.'.$field['fields'][1]['type'],
      [
        "field" => $field['fields'][1],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </p>
</div>
