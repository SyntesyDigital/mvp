<div class="item {{$class}} {{$settings['htmlClass'] or ''}}">

  @php
    $urlField = $field['fields'][3];
    $link = "";
    $target = "";
    if(isset($urlField['value']['content'])){
      //is internal
      $content = $urlField['value']['content'];
      $link = $content->url;
    }
    else {
      //is external
      $target = "_blank";
      $link = isset($urlField['value']['url'][App::getLocale()]) ? $urlField['value']['url'][App::getLocale()] : '';
    }
  @endphp

  @include('bwo::partials.fields.'.$field['fields'][0]['type'],
    [
      "field" => $field['fields'][0],
      "settings" => $settings,
      "div" => false,
      "class" => 'center-block'
    ]
  )


@if(isset($field['fields'][1]['value'][App::getLocale()]) && $field['fields'][1]['value'][App::getLocale()] != '')
  <div class="carousel-caption">
    @if($link != "")
      <a href="{{$link}}" target="{{$target or ''}}">
    @endif
      <h3>
        @include('bwo::partials.fields.'.$field['fields'][1]['type'],
          [
            "field" => $field['fields'][1],
            "settings" => $settings,
            "div" => false
          ]
        )
      </h3>
    @if($link != "")
      </a>
    @endif
    <p>
      @include('bwo::partials.fields.'.$field['fields'][2]['type'],
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
