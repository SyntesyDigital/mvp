@extends('architect::layouts.master')

@section('content')

    {!!
        Form::open([
            'url' => '',
            'method' => 'POST',
        ])
    !!}

    <div class="container rightbar-page content">

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
            <div class="col-xs-6 col-xs-offset-3 page-content">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

    </div>


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
    {!! Form::close() !!}

@stop

@push('plugins')
    {{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
    {{ Html::script('/modules/architect/js/architect.js') }}
@endpush

@push('javascripts')
<script>

  var csrf_token = "{{csrf_token()}}";

  $(function(){

    var appendElement = function(element){

        console.log(element);

  		var classSelector = element.parent_id != null ? ".element-container-" + element.parent_id : ".sortable-list";

  		$(classSelector).append(''+
  			'<li class="item drag" data-id="'+element.id+'" data-class="element">'+
            '<div class="item-bar">'+
    	  			'<i class="fa fa-bars"></i> &nbsp; '+element.name+
    	  			'<div class="actions">'+
    		  			'<a href="#" class="btn btn-link"><i class="fa fa-pencil"></i> &nbsp; Editar</a>&nbsp;'+
    		  			'<a href="#" data-ajax="#" class="btn btn-link text-danger btn-delete"><i class="fa fa-trash"></i> &nbsp; Esborrar</a>'+
    		  		'</div>'+
            '</div>'+
  	  			'<ol class="element-container-'+element.id+'">'+
  			  	'</ol>'+
  	  		'</li>'
  		);

  	};

    $.getJSON('{{route("menu.show.tree", $menu)}}',function(elements){

  		$(".sortable-list").empty();
        var elements = JSON.parse(elements);

        elements.forEach(function(element) {
          console.log(element);
        });
  		// for(var id in items){
        //     console.log('ID => ', data);
  		// 	item = items[id];
  		// 	appendElement(item);
  		// }

      // var group = $("ol.sortable-list").sortable({
      //   onDrop: function ($item, container, _super) {
  		// 	    var parent = container.el.parent();
      //           var data = group.sortable("serialize").get();
  		// 	    _super($item, container);
      //           updateOrder();
  		// 	}
  		// });
      //
      // var updateOrder = function() {
      //
  		// 	var newOrder = group.sortable("serialize").get();
      //
      //       console.log("update ORDER")
      //
  		// 	// $.ajax({
	  //       //     type: 'POST',
	  //       //     url: routes.updateOrder,
	  //       //     data: {
	  //       //     	_token: csrf_token,
	  //       //     	order : newOrder
	  //       //     },
	  //       //     dataType: 'html',
	  //       //     success: function(data){
      //       //
	  //       //         var rep = JSON.parse(data);
      //       //
	  //       //         if(rep.success){
	  //       //             //change
	  //       //             toastr.success('Ordre guardat amb éxit', '', {timeOut: 3000});
	  //       //             //location.reload();
	  //       //         }
	  //       //         else {
	  //       //         	//error
	  //       //         	toastr.error('Error al guardar el nou ordre', '', {timeOut: 3000});
	  //       //         }
	  //       //     }
  		// 	// });
      //
  		// };


    });


  });
</script>

@endpush
