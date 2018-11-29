@extends('architect::layouts.master')

@section('content')
<div class="body">
    @if(isset($users))
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des Utilisateurs
                        <a href="{{route('admin.users.create')}}" class="pull-right btn btn-primary">
                            Créer un Utilisateur
                        </a>
                    </h3>
                    <h6 class="card-subtitle mb-2 text-muted">Utilisateurs non candidates</h6>

                   <table class="table" id="table-users" style="width:100%">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Nom</th>
                               <th>Prénom</th>
                               <th>Droit(s)</th>
                               <th data-filter="select" data-values="{!! base64_encode(json_encode(\App\Models\User::getStatus())) !!}">Etat</th>
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
                           </tr>
                       </tfoot>
                   </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
</div>
@endsection


@push('javascripts')
    <script>
    var csrf_token = "{{csrf_token()}}";
    var routes = {
        data : '{{ route("rrhh.admin.users.data") }}',
    };
    </script>

    {{ Html::script('js/libs/datatabletools.js')}}
    {{ Html::script('/js/admin/users/userslist.js') }}
@endpush
