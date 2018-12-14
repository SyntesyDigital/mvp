@extends('architect::layouts.master')

@section('content')
<div class="container leftbar-page">

  @include('rrhh::admin.partials.offers-nav')

    <div class="col-xs-offset-2 col-xs-10 page-content">

        <h3 class="card-title">Liste des tags</h3>

        <a href="{{route('rrhh.admin.tags.create')}}" class="pull-right btn btn-primary">
            Ajouter un tag
        </a>

        <h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des tags des offres d'emploi</h6>

        <table class="table" id="table" data-url="{{ route("rrhh.admin.tags.data") }}" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tag</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
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
    {{ Html::style('/modules/rrhh/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/rrhh/plugins/datatables/datatables.min.js') }}

    <!-- Syntesy Datatable Lib  -->
    {{ Html::script('/modules/rrhh/js/libs/datatabletools.js')}}

    <!-- Toastr -->
    {{ Html::style('/modules/rrhh/plugins/toastr/toastr.min.css') }}
    {{ Html::script('/modules/rrhh/plugins/toastr/toastr.min.js') }}

    <!-- Dialog -->
    <script src="{{ asset('/modules/rrhh/js/libs/dialog.js')}}"></script>
@endpush

@push('javascripts')
<script>
var csrf_token = "{{ csrf_token() }}";
var routes = {
	data : '{{ route("rrhh.admin.tags.data") }}',
};
</script>


{{ Html::script('/modules/rrhh/js/admin/tags/index.js')}}
@endpush
