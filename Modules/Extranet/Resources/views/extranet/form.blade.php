@extends('architect::layouts.master')

@section('content')

{!!
    Form::open([
        'url' => isset($extranet_id)
            ? route('extranet.update', $extranet_id)
            : route('extranet.store'),
        'method' => 'POST',
        'id' => 'form-model'
    ])
!!}

{{ Form::hidden('_method','POST') }}

<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('extranet.extranet.index')}}" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
                <h1><i class="fa {{$model->icon}}"></i>&nbsp;{{$model->title}}</h1>
                <div class="float-buttons pull-right">
                    <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="model" value="{{$modelId}}" />
<div class="container rightbar-page">
    <div class="col-md-8 col-md-offset-2 page-content">

        @foreach($modelForm as $node)
            @include('extranet::extranet.partials.node', [
              'node' => $node,
              'item' => isset($sinistre_values) ? $sinistre_values : null
            ])
        @endforeach

        <br/>
        <br/>

    </div>
</div>

{!! Form::close() !!}

@endsection


@push('javascripts-libs')
<!-- Datepicker -->
{{ Html::style('/modules/extranet/plugins/datepicker/bootstrap-datetimepicker.min.css') }}
{{ Html::script('/modules/extranet/plugins/datepicker/moment-with-locales.min.js') }}
{{ Html::script('/modules/extranet/plugins/datepicker/bootstrap-datetimepicker.min.js') }}

<!-- Vendors -->
{{ Html::script('/modules/extranet/plugins/ckeditor/ckeditor.js') }}
@endpush


@push('javascripts')

<script>
  $(document).ready(function() {
    $(document).on('click', ".btn-submit-primary", function(e){
        e.preventDefault();
        this.closest('form').submit()
    });
    $('#form-model .datepicker-extranet').datepicker({
         weekStart: 1,
         format: 'dd/mm/yyyy'
    });
  });
</script>
@endpush
