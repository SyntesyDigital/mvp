<div id="{{$field['settings']['htmlId'] or ''}}" class="banner banner-text newsletter blog {{$field['settings']['htmlClass'] or ''}}">

    <h3>
      @include('turisme::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => $field['settings'],
          "div" => false
        ]
      )
    </h3>
    <form action="#"><input type="email"><input type="submit" ></form>

</div>
