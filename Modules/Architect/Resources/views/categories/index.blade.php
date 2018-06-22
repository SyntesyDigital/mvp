@extends('architect::layouts.master')

@section('content')


<div class="container leftbar-page">

  @include('architect::partials.content-nav',['typologies' => $typologies])

  <div class="col-xs-offset-2 col-xs-10 page-content">

    <h3 class="card-title">Categories</h3>
    <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir categoria</a>

    <div class="grid-items">
      <div class="row">
        @foreach($categories as $category)
          <div class="col-xs-3">
              <a href="{{ route('categories.show', $category)}}">
                <div class="grid-item">
                    <p class="grid-item-name">
                        {{$category->name}}
                    </p>
                </div>
              </a>
          </div>
        @endforeach()
      </div>
    </div>

  </div>

</div>


@stop
