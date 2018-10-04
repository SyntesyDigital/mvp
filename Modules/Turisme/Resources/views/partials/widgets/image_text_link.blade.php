<div id="{{$field['settings']['htmlId'] or ''}}" class="widget image_text_link image {{$field['settings']['htmlClass'] or ''}}">

@php
  //TODO move this to a widget config
  $field['settings']['cropsAllowed'] = 'medium';
@endphp
    <p class="image">
      @include('turisme::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => $field['settings'],
          "div" => false
        ]
      )
    </p>

    <h3>
      @include('turisme::partials.fields.'.$field['fields'][1]['type'],
        [
          "field" => $field['fields'][1],
          "settings" => $field['settings'],
          "div" => false
        ]
      )
    </h3>

    @include('turisme::partials.fields.'.$field['fields'][2]['type'],
      [
        "field" => $field['fields'][2],
        "settings" => $field['settings'],
        "div" => false
      ]
    )

</div>
