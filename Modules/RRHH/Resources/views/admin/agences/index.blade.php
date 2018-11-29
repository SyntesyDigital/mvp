@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des agences
                        <a href="{{route('admin.agences.create')}}" class="pull-right btn btn-primary">
                            Ajouter une agence
                        </a>
                    </h3>
                    <h6 class="card-subtitle mb-2 text-muted">Toutes les agences</h6>

                    <table class="table" id="table-agences" style="width:100%">
                        <thead>
                           <tr>
                               <th>#</th>
                               <th>Nom</th>
                               <th>Address</th>
                               <th></th>
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
        </div>
    </div>
</div>
@endsection


@push('javascripts')
    <script>
    var csrf_token = "{{csrf_token()}}";
    var routes = {
        data : '{{ route("rrhh.admin.agences.data") }}',
    };
    </script>

    {{ Html::script('js/libs/datatabletools.js')}}
    {{ Html::script('/js/admin/agences/agenceslist.js') }}
@endpush
