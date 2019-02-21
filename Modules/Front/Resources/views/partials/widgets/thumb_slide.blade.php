<div class="item {{$class or ''}}">
  @include('front::partials.fields.'.$field['fields'][0]['type'],
    [
      "field" => $field['fields'][0],
      "settings" => $settings,
      "div" => false,
      "class" => 'center-block'
    ]
  )
  @if(isset($field['fields'][1]['value']['title'][App::getLocale()]) && $field['fields'][1]['value']['title'][App::getLocale()] != '')

    <div class="carousel-caption">
  	  <p>
        @include('front::partials.fields.'.$field['fields'][1]['type'],
          [
            "field" => $field['fields'][1],
            "settings" => $settings,
            "div" => false
          ]
        )
      </p>
      <p class="subtitle">
        @include('front::partials.fields.'.$field['fields'][2]['type'],
          [
            "field" => $field['fields'][2],
            "settings" => $settings,
            "div" => false
          ]
        )
      </p>
    </div>
  @endif
</div>
