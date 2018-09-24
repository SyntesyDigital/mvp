<div class="item {{$class or ''}}">
  @include('turisme::partials.fields.'.$field['fields'][0]['type'],
    [
      "field" => $field['fields'][0],
      "settings" => $settings,
      "div" => false,
      "class" => 'center-block'
    ]
  )

  <div class="carousel-caption">
	  <p>
      @include('turisme::partials.fields.'.$field['fields'][1]['type'],
        [
          "field" => $field['fields'][1],
          "settings" => $settings,
          "div" => false
        ]
      )
    </p>
    <p class="subtitle">
      @include('turisme::partials.fields.'.$field['fields'][2]['type'],
        [
          "field" => $field['fields'][2],
          "settings" => $settings,
          "div" => false
        ]
      )
    </p>
  </div>
</div>
