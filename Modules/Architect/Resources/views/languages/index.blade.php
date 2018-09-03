@extends('architect::layouts.master')

@section('content')
<div class="container leftbar-page">
  <div class="col-xs-offset-2 col-xs-8 page-content">

    <h3 class="card-title">Llenguatges</h3>
    <a href="{{route('languages.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir llenguatge</a>

    <table class="table" id="table" data-url="{{route('languages.data')}}">
        <thead>
           <tr>
               <th></th>  
               <th>Nom</th>
               <th>Codi ISO</th>
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
@stop

@push('plugins')
    {{ Html::script('/modules/architect/plugins/datatables/datatables.min.js') }}
    {{ HTML::style('/modules/architect/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
    {{ Html::script('/modules/architect/js/libs/datatabletools.js') }}
    {{ Html::script('/modules/architect/js/architect.js') }}
@endpush

@push('javascripts-libs')
<script>
    architect.languages.init({
        'table' : $('#table')
    })
</script>
@endpush
