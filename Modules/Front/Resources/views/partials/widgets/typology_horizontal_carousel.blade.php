<div
  id="{{$field['settings']['htmlId'] or ''}}"
  class="widget slider list-items image {{$field['settings']['htmlClass'] or ''}}">
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

  <div id="typology-horizontal-carousel"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
  >
  </div>
</div>
