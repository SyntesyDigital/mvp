@include('front::partials.fields.only_href',
  [
    "field" => $field['fields'][1]
  ]
)
  @include('front::partials.fields.'.$field['fields'][0]['type'],
    [
      "field" => $field['fields'][0],
      "settings" => $settings,
      "div" => false,
      "class" => 'author-testimonial'
    ]
  )
</a>
