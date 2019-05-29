<div id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">

  @include('front::fields.text',$fields["title"])
  @include('front::fields.richtext',$fields["richtext"])
  @include('front::fields.image',$fields["image"])
  @include('front::fields.link',$fields["link"])

</div>
