@extends('architect::layouts.master')


@section('content')
<div class="container leftbar-page">

  @include('extranet::admin.partials.offers-nav')

    <div class="col-xs-offset-2 col-xs-10 page-content">

        <h3 class="card-title">Liste des candidatures spontanées</h3>
        <h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des candidatures spontanées</h6>

        <table class="table" id="table" data-url="{{ route("extranet.admin.applications.spontaneous.data") }}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Prénom</th>
                    <th>Code postal</th>
                    <th>Localité</th>
                    <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\Extranet\Entities\Offers\Candidate::getTypes())) !!}">Type</th>
                    <th>Date de candidature</th>
                    <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\Extranet\Entities\Offers\Application::getStatus())) !!}">Etat</th>
                    <th></th>
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
@endpush

@push('javascripts')
    {{ Html::script('/modules/extranet/js/libs/dialog.js')}}
    {{ Html::script('/modules/extranet/js/libs/datatabletools.js')}}
    {{ Html::script('/modules/extranet/js/admin/applications/spontaneous.js')}}
@endpush
