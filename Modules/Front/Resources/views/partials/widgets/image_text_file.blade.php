
@php
  $settings = isset($settings) ? $settings : $field['settings'];
  $settings = json_decode(json_encode($settings), true);
@endphp
<div id="{{$field['settings']['htmlId'] or ''}}" class="image_text_file image">

    <p class="image">
      @include('front::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => $settings,
          "div" => false
        ]
      )
    </p>

    <p class="titol">
      @include('front::partials.fields.'.$field['fields'][1]['type'],
        [
          "field" => $field['fields'][1],
          "settings" => $settings,
          "div" => false
        ]
      )
    </p>

    <div class="intro">
    @include('front::partials.fields.'.$field['fields'][2]['type'],
      [
        "field" => $field['fields'][2],
        "settings" => $settings,
        "div" => false
      ]
    )
    </div>

    @include('front::partials.fields.'.$field['fields'][3]['type'],
      [
        "field" => $field['fields'][3],
        "settings" => $settings,
        "div" => false,
        "class" => 'opcions pdf'
      ]
    )

</div>
