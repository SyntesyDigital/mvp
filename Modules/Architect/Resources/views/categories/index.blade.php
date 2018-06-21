@extends('architect::layouts.master')

@section('content')
  <div class="container grid-page">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">

        <div class="page-title">
          <h1>Categories</h1> <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir categoria</a>
        </div>

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
  </div>

@stop
