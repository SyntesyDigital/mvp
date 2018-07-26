<div class="item {{$class or ''}}">
  <div class="text-testimonial">
     @include('turisme::partials.fields.'.$field['fields'][0]['type'],
       [
         "field" => $field['fields'][0],
         "settings" => $settings,
         "div" => false,
         "class" => 'author-testimonial'
       ]
     )
  </div>
  <p class="author-testimonial">
    <span>
      @include('turisme::partials.fields.'.$field['fields'][1]['type'],
        [
          "field" => $field['fields'][1],
          "settings" => $settings,
          "div" => false,
        ]
      )
    </span>
    @include('turisme::partials.fields.'.$field['fields'][2]['type'],
      [
        "field" => $field['fields'][2],
        "settings" => $settings,
        "div" => false,
      ]
    )
  </p>
</div>
