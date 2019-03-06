<div id="{{$field['settings']['htmlId'] or ''}}" class="destacats {{$field['settings']['htmlClass'] or ''}}" >

  <ul>

      @foreach($field['value'] as $index => $widget)
        <li class="col-5">
          <div class="promo-image-text">
            <p class="image">
              @include('front::partials.fields.'.$widget['fields'][0]['type'],
                [
                  "field" => $widget['fields'][0],
                  "settings" => $field['settings'],
                  "div" => false,
                  'width' => 73,
                  'height' => 54
                ]
              )
            </p>
            <p class="link">
              @include('front::partials.fields.'.$widget['fields'][1]['type'],
                [
                  "field" => $widget['fields'][1],
                  "settings" => $field['settings'],
                  "div" => false
                ]
              )
            </p>
          </div>
        </li>
      @endforeach


    </ul>

</div>
