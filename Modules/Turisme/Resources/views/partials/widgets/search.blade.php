<div id="{{$field['settings']['htmlId'] or ''}}" class="widget-search {{$field['settings']['htmlClass'] or ''}}">
  {{$_REQUEST['q']}}
  <div id="search" class="search"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    {{isset($_REQUEST['q'])?'text='.base64_encode(json_encode($_REQUEST['q'])) :''}}

  >
  </div>

</div>
