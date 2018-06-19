@extends('architect::layouts.master')

@section('content')
  <div class="container grid-page">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">

        <div class="page-title">
          <h1>Tags</h1> <a href="{{route('tags.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir tag</a>
        </div>

        <div class="grid-items">
          <div class="row">
              @foreach($tags as $tag)
                <div class="col-xs-3">
                    <a href="{{ route('tags.show', $tag)}}">
                      <div class="grid-item">
                          <p class="grid-item-name">
                              {{$tag->name}}
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
