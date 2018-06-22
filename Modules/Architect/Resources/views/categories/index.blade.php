@extends('architect::layouts.master')

@section('content')


<div class="container leftbar-page">

  @include('architect::partials.content-nav',['typologies' => $typologies])

  <div class="col-xs-offset-2 col-xs-10 page-content">

    <h3 class="card-title">Categories</h3>
    <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir categoria</a>

    <div class="grid-items">
      <div class="row">
        <ol class='sortable-list'>
          @foreach($categories as $category)
              <li class="item drag" data-id="'+category.id+'" data-class="category">
                <div class="item-bar">
                  <i class="fa fa-bars"></i> &nbsp; {{ $category->name }}
                  <div class="actions">
                    <a href="{{ route('categories.show', $category)}}" class="btn btn-link"><i class="fa fa-pencil"></i> &nbsp; Editar</a>&nbsp;
                    <a href="#" class="btn btn-link text-danger" data-id="{{$category->id}}"><i class="fa fa-trash"></i> &nbsp; Esborrar</a>
                  </div>
                </div>
                <ol class="category-container-{{$category->id}}">
                </ol>
              </li>
          @endforeach()
        </ol>
      </div>
    </div>

  </div>

</div>


@stop

@push('javascripts')
<script>
  $(function(){


    var group = $("ol.sortable-list").sortable({
      onDrop: function ($item, container, _super) {

			    var parent = container.el.parent();
          var data = group.sortable("serialize").get();
			    _super($item, container);
			}
		});

  });
</script>

@endpush
