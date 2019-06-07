@extends('architect::layouts.master')

@section('content')
    <div id="element-form"
      fields={{base64_encode(json_encode($fields,true))}}
      model={{base64_encode(json_encode($model,true))}}
      @if((isset($element)) && $element)element={{base64_encode($element->toJson())}}@endif
    ></div>
@stop

@push('plugins')
    {{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
    {{ Html::script('/modules/architect/js/architect.js') }}
@endpush

@push('javascripts-libs')
<script>
var routes = {
  'typologies' : "{{route('typologies')}}",
  'showTypology' : "{{route('typologies.show',['id' => ':id'])}}"
};
</script>

@endpush
