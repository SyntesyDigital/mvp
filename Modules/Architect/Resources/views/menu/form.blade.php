@extends('architect::layouts.master')

@section('content')


    <!-- React Modal Edit Menu -->
    <div id="menu-edit-modal"
      menu="{{$menu->id or null}}"
    ></div>

    {!!
        Form::open([
            'url' => '',
            'method' => 'POST',
        ])
    !!}

    <div class="page-bar">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <a href="{{route('menu.index')}}" class="btn btn-default btn-close"> <i class="fa fa-angle-left"></i> </a>
            <h1>
              <i class="fa fa-list "></i>
              @if(isset($menu))
                Edita menu "{{$menu->name or ''}}"
              @else
                Nova menu
              @endif
            </h1>

            <div class="float-buttons pull-right">

            <div class="actions-dropdown">
              <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
                Accions
                <b class="caret"></b>
                <div class="ripple-container"></div>
              </a>
                <ul class="dropdown-menu dropdown-menu-right default-padding">
                    <li class="dropdown-header"></li>
                    <li>
                        <a href="{{route('menu.create')}}">
                            <i class="fa fa-plus-circle"></i>
                            &nbsp;Nou
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-danger">
                            <i class="fa fa-trash text-danger"></i>
                            &nbsp;
                            <span class="text-danger">Esborrar</span>
                        </a>
                    </li>
                </ul>
              </div>


              {!!
                  Form::submit('Guardar', [
                      'class' => 'btn btn-primary'
                  ])
              !!}

            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container rightbar-page content">

        <div class="sidebar">

          <div>
            <div class="form-group bmd-form-group sidebar-item">
               <label htmlFor="name" class="bmd-label-floating">Nom</label>
               <input type="text" class="form-control"  id="name" name="name" value="{{$menu->name or ''}}" />

            </div>

            <hr/>

          </div>

        </div><!-- end sidebar -->

        <div class="col-xs-9 page-content">

          @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif


          <div class="grid-items">
            <div class="row">
              <ol class='sortable-list'>
                Carregant items...
              </ol>
            </div>
          </div>


          <div class="page-row add-row-block">
            <a href="" class="btn btn-default add-new-item">
              <i class="fa fa-plus-circle"></i> Afegir pàgina
            </a>
          </div>

        </div>

    </div>

    <!--

    <div class="container rightbar-page content">
        <div class="col-xs-8 col-xs-offset-2 page-content">
            <div class="field-group">
                <div class="grid-items">
                  <div class="row">
                    <ol class='sortable-list'>
                      Carregant items...
                    </ol>
                  </div>
                </div>
            </div>
        </div>
    </div>
    -->

    {!! Form::close() !!}

@stop

@push('plugins')
    {{ Html::script('/modules/architect/plugins/datatables/datatables.min.js') }}
    {{ HTML::style('/modules/architect/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/architect/js/libs/datatabletools.js') }}
    {{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
    {{ Html::script('/modules/architect/js/architect.js') }}
@endpush

@push('javascripts')
<script>

  var routes = {
    'contents.data' : '{{ route('contents.modal.data') }}',
    //'menu.tree' : '{{route("menu.show.tree", $menu)}}',
    showItem : '{{route("categories.show",["id"=>":id"])}}',
    deleteItem : '{{ route("categories.delete",["id"=>":id"]) }}',
    getData : '{{route("categories.data") }}',
    updateOrder : '{{route("categories.update-order")}}'
  };

  var csrf_token = "{{csrf_token()}}";

  $(function(){

    architect.menu.form.init();

  });
</script>

@endpush
