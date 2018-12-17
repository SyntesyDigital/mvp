<div id="{{$field['settings']['htmlId'] or ''}}"  class="banner banner-small offer-banner {{$field['settings']['htmlClass'] or ''}}" style="background-image:url('{{asset('modules/bwo/images/blog-banner.jpg')}}')">
  <div class="horizontal-inner-container">
      <h1>{{$content->getFieldValue('title')}}</h1>

      @include('bwo::partials.fields.'.$field['fields'][0]['type'],
        [
          "field" => $field['fields'][0],
          "settings" => $field['settings'],
          "div" => false
        ]
      )

    </div>
  </div>
</div>
