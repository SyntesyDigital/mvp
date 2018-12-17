<div id="{{$field['settings']['htmlId'] or ''}}" class="widget-blog offers-container {{$field['settings']['htmlClass'] or ''}}">


  <div id="blog" class="blog blog-container"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    {{isset($_REQUEST['category'])?'categoryId='.$_REQUEST['category']:''}}
  >
  </div>

</div>
