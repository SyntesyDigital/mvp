@extends('architect::layouts.master')


@section('content')
<div class="container leftbar-page">

  @include('rrhh::admin.partials.offers-nav')

  <div class="col-xs-offset-2 col-xs-10 page-content">

                    <h3 class="card-title">Liste des candidatures</h3>
				            <h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des candidatures</h6>

                    <table class="table" id="table" data-url="{{ route("rrhh.admin.applications.data") }}" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom Prénom</th>
                                <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Candidate::getTypes())) !!}">Type</th>
                                <th>Offre</th>
                                <th>Date de candidature</th>
                                <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Application::getStatus())) !!}">Etat</th>
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
@endpush


@push('javascripts')
{{ Html::script('/modules/rrhh/js/libs/datatabletools.js')}}
{{ Html::script('/modules/rrhh/js/admin/applications/index.js')}}
{{ Html::script('/modules/rrhh/js/libs/dialog.js')}}

@endpush
