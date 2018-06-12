@extends('architect::layouts.master')

@section('content')

<div id="content-form"
users="{{ $users ? base64_encode($users->toJson()) : null }}"
@if(isset($typology))typology="{{base64_encode($typology->toJson())}}"@endif
></div>

@stop

@push('plugins')
    {{ Html::script('/modules/architect/plugins/dropzone/dropzone.min.js') }}
    {{ HTML::style('/modules/architect/plugins/dropzone/dropzone.min.css') }}

    {{ Html::script('/modules/architect/plugins/datatables/datatables.min.js') }}
    {{ HTML::style('/modules/architect/plugins/datatables/datatables.min.css') }}

    {{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
    {{ Html::script('/modules/architect/js/libs/datatabletools.js') }}
    {{ Html::script('/modules/architect/js/architect.js') }}
@endpush

@push('javascripts-libs')
<script>
var routes = {
  'medias.data' : "{{route('medias.data')}}",
  'medias.index' : '{{ route('medias.index') }}',
  'medias.store' : '{{ route('medias.store') }}',
  'medias.show' : '{{ route('medias.show') }}',
  'medias.delete' : '{{ route('medias.delete') }}',
  'medias.update' : '{{ route('medias.update') }}'
};
</script>

@endpush
