<li id="{{$field['settings']['htmlId'] or ''}}" class="image">

    <p class="image">
      @include('turisme::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => isset($settings) ? $settings : $field['settings'],
          "div" => false
        ]
      )
    </p>

    <p class="titol">
      @include('turisme::partials.fields.'.$field['fields'][1]['type'],
        [
          "field" => $field['fields'][1],
          "settings" => isset($settings) ? $settings : $field['settings'],
          "div" => false
        ]
      )
    </p>

    @include('turisme::partials.fields.'.$field['fields'][2]['type'],
      [
        "field" => $field['fields'][2],
        "settings" => isset($settings) ? $settings : $field['settings'],
        "div" => false
      ]
    )

    @include('turisme::partials.fields.'.$field['fields'][3]['type'],
      [
        "field" => $field['fields'][3],
        "settings" => isset($settings) ? $settings : $field['settings'],
        "div" => false,
        "class" => 'opcions pdf'
      ]
    )

</li>
