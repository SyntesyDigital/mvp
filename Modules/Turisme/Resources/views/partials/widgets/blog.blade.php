<div id="{{$field['settings']['htmlId'] or ''}}" class="widget-blog {{$field['settings']['htmlClass'] or ''}}">


  <div id="blog" class="blog"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    entrevistas="0"
    {{isset($_REQUEST['category'])?'categoryId='.$_REQUEST['category']:''}}
    {{isset($_REQUEST['text'])?'text='.$_REQUEST['text'] :''}}
    {{isset($_REQUEST['startDate'])?'startDate='.$_REQUEST['startDate']:''}}
    {{isset($_REQUEST['endDate'])?'endDate='.$_REQUEST['endDate']:''}}
  >
  </div>

</div>
