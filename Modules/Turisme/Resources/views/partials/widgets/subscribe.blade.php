<div id="{{$field['settings']['htmlId'] or ''}}" class="banner banner-text newsletter blog {{$field['settings']['htmlClass'] or ''}}">

    <h3>
      @include('turisme::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => $field['settings'],
          "div" => false,
          "p" => false
        ]
      )
    </h3>
    <!-- React Subscribe -->
    <div id="subscribe"></div>

</div>
