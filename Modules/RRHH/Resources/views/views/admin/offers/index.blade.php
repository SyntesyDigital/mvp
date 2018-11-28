@extends('layouts.app')

@section('content')
<div class="body">

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des offres d'emploi
                        <a href="{{route('admin.offers.create')}}" class="pull-right btn btn-primary">
                            Ajouter une offre
                        </a>
                    </h3>
    				<h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des offres d'emploi</h6>

                    <table class="table" id="table" data-url="{{ route("admin.offers.index.data") }}" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Date de création</th>
                                <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Offer::getStatus())) !!}">Etat</th>
                                <th>Nombre de candidatures</th>
                                <th data-filter="select" data-ajax="{{ route("admin.offers.index.data.recipients") }}">Destinataire interne</th>
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
<script>
var csrf_token = "{{csrf_token()}}";
var routes = {
	data : '{{ route("admin.offers.index.data") }}',
    recipients: '{{ route("admin.offers.index.data.recipients") }}'
};
</script>

{{ Html::script('js/libs/datatabletools.js')}}
{{ Html::script('js/admin/offers/index.js')}}
@endpush
