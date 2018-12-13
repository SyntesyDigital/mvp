<div id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">

  @include('bwo::fields.text',$fields["title"])
  @include('bwo::fields.richtext',$fields["richtext"])
  @include('bwo::fields.image',$fields["image"])
  @include('bwo::fields.link',$fields["link"])

</div>
