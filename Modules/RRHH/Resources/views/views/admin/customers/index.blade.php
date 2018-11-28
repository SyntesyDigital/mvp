@extends('layouts.app')

@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des clients
                        <a href="{{route('admin.customers.create')}}" class="pull-right btn btn-primary">
                            Ajouter un client
                        </a>
                    </h3>
                    <h6 class="card-subtitle mb-2 text-muted">Tous les clients</h6>

                    <table class="table" id="table-customers" style="width:100%">
                        <thead>
                           <tr>
                               <th>#</th>
                               <th>Nom</th>
                               <th>Ville</th>
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
        data : '{{ route("admin.customers.data") }}',
    };
    </script>

    {{ Html::script('js/libs/datatabletools.js')}}
    {{ Html::script('/js/admin/customers/customerslist.js') }}
@endpush
