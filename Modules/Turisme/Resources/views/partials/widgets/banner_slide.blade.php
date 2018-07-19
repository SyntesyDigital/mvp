<div class="item {{$class}} {{$settings['htmlClass'] or ''}}">

  @include('turisme::partials.fields.'.$field['fields'][0]['type'],
    [
      "field" => $field['fields'][0],
      "settings" => $settings,
      "div" => false,
      "class" => 'center-block'
    ]
  )

  <div class="carousel-caption">
    <h3>
      @include('turisme::partials.fields.'.$field['fields'][1]['type'],
        [
          "field" => $field['fields'][1],
          "settings" => $settings,
          "div" => false
        ]
      )
    </h3>
    <p>
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
