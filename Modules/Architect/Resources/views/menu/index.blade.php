@extends('architect::layouts.master')

@section('content')
<div class="container leftbar-page">
  <div class="col-xs-offset-2 col-xs-10 page-content">

    <h3 class="card-title">Menus</h3>
    <a href="{{route('menu.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir menu</a>

    <table class="table" id="table">
        <thead>
           <tr>
               <th>Nom</th>
               <th></th>
           </tr>
        </thead>

        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <th>
                        <a href="{{route('menu.show', $menu)}}">{{$menu->name}}</a>
                    </th>
                    <th></th>
                </tr>
            @endforeach()
        </tbody>
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
    // architect.users.init({
    //     'table' : $('#table'),
    //     'urls': {
    //         'index' : '{{ route('users.data') }}',
    //         'show' : '{{ route('users.show') }}',
    //         'delete' : '{{ route('users.delete') }}',
    //     }
    // })
</script>
@endpush
