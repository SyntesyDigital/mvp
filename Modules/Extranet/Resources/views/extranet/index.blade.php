@extends('architect::layouts.master')


@section('content')
<div class="container leftbar-page">
  @include('extranet::admin.partials.models-nav')
    <div class="col-xs-offset-2 col-xs-10 page-content">

        <h3 class="card-title">{{$model->title}}</h3>

        <a href="{{route('extranet.extranet.create',$model->id)}}" class="pull-right btn btn-primary">
            Ajouter une {{$model->title}}
        </a>

        <h6 class="card-subtitle mb-2 text-muted"></h6>

        <table class="table" id="table" data-url="#" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Date de création</th>
                    <th id="actions-th"></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@push('javascripts-libs')
    <!-- Datatables -->
    {{ Html::style('/modules/extranet/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/extranet/plugins/datatables/datatables.min.js') }}
    {{ Html::script('/modules/extranet/js/libs/datatabletools.js')}}

    {{ Html::script('/modules/extranet/js/libs/dialog.js')}}
@endpush

@push('javascripts')
<script>
var routes = {

};
</script>

{{ Html::script('/modules/extranet/js/admin/extranet/index.js')}}
@endpush
