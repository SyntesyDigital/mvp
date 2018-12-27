@extends('architect::layouts.master')


@section('content')
<div class="container leftbar-page">
  @include('rrhh::admin.partials.offers-nav')
    <div class="col-xs-offset-2 col-xs-10 page-content">

        <h3 class="card-title">Liste des offres d'emploi</h3>

        <a href="{{route('rrhh.admin.offers.create')}}" class="pull-right btn btn-primary">
            Ajouter une offre
        </a>

        <h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des offres d'emploi</h6>

        <table class="table" id="table" data-url="{{ route("rrhh.admin.offers.index.data") }}" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Date de création</th>
                    <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Offer::getStatus())) !!}">Etat</th>
                    <th>Nombre de candidatures</th>
                    <th data-filter="select" data-ajax="{{ route("rrhh.admin.offers.index.data.recipients") }}">Destinataire interne</th>
                    <th id="actions-th"></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
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
    {{ Html::style('/modules/rrhh/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/rrhh/plugins/datatables/datatables.min.js') }}
    {{ Html::script('/modules/rrhh/js/libs/datatabletools.js')}}

    {{ Html::script('/modules/rrhh/js/libs/dialog.js')}}
@endpush

@push('javascripts')
<script>
var routes = {
	data : '{{ route("rrhh.admin.offers.index.data") }}',
    recipients : '{{ route("rrhh.admin.offers.index.data.recipients") }}'
};
</script>

{{ Html::script('/modules/rrhh/js/admin/offers/index.js')}}
@endpush
