@extends('architect::layouts.master')


@section('content')
<div class="container leftbar-page">

  @include('rrhh::admin.partials.offers-nav')

  <div class="col-xs-offset-2 col-xs-10 page-content">


        <h3 class="card-title">Liste des clients        </h3>

            <a href="{{route('rrhh.admin.customers.create')}}" class="pull-right btn btn-primary">
                Ajouter un client
            </a>
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
@endsection

@push('javascripts-libs')
    <!-- Datatables -->
    {{ Html::style('/modules/rrhh/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/rrhh/plugins/datatables/datatables.min.js') }}
    {{ Html::script('/modules/rrhh/js/libs/datatabletools.js') }}
    {{ Html::script('/modules/rrhh/js/libs/dialog.js') }}
@endpush

@push('javascripts')
    <script>
    var csrf_token = "{{csrf_token()}}";
    var routes = {
        data : '{{ route("rrhh.admin.customers.data") }}',
    };
    </script>

    {{ Html::script('/modules/rrhh/js/admin/customers/customerslist.js') }}
@endpush
