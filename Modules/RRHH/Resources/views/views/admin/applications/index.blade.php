@extends('layouts.app')

@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des candidatures</h3>
    				<h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des candidatures</h6>

                    <table class="table" id="table" data-url="{{ route("admin.applications.data") }}" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom Prénom</th>
                                <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Candidate::getTypes())) !!}">Type</th>
                                <th>Offre</th>
                                <th>Date de candidature</th>
                                <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Application::getStatus())) !!}">Etat</th>
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
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascripts')
{{ Html::script('js/libs/datatabletools.js')}}
{{ Html::script('js/admin/applications/index.js')}}
@endpush
