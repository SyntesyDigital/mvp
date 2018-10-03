<div id="{{$field['settings']['htmlId'] or ''}}" class="widget-search {{$field['settings']['htmlClass'] or ''}}">

  <div id="search" class="search"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    {{isset($_REQUEST['q'])?'text='.$_REQUEST['q'] :''}}

  >
  </div>

</div>
