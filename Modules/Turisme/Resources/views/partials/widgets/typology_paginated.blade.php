<div
  id="{{$field['settings']['htmlId'] or ''}}"
  class="widget blog list-items image {{$field['settings']['htmlClass'] or ''}} {{$field['settings']['columns'] or ''}}">
  <h3>
    @include('turisme::partials.fields.'.$field['fields'][0]['type'],
      [
        "field" => $field['fields'][0],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </h3>

  <div id="typology-paginated"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>

  @if(isset($field['fields'][1]))
  <p class="button">
    @include('turisme::partials.fields.'.$field['fields'][1]['type'],
      [
        "field" => $field['fields'][1],
        "settings" => $field['settings'],
        "div" => false
      ]
    )
  </p>
    @endif
</div>
