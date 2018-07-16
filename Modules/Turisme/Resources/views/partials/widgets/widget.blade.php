<div id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">

  @include('turisme::fields.text',$fields["title"])
  @include('turisme::fields.richtext',$fields["richtext"])
  @include('turisme::fields.image',$fields["image"])
  @include('turisme::fields.link',$fields["link"])

</div>
