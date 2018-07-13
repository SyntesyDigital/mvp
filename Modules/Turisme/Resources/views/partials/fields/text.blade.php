<div id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">
  {{$field['value'][App::getLocale()] or ''}}
</div>
