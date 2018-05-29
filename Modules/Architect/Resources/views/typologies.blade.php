@extends('architect::layouts.master')

@section('content')
  <div class="container grid-page">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">

        <div class="page-title">
          <h1>Tipologies</h1> <a href="{{route('typologies.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir tipologia</a>
        </div>

        <div class="grid-items">
          <div class="row">
              @foreach($typologies as $typology)
                <div class="col-xs-3">
                    <div class="grid-item">
                        <i class="fa {{$typology->icon}}"></i>

                        <p class="grid-item-name">
                            <a href="{{ route('typologies.show', $typology)}}">{{$typology->name}}</a>
                        </p>
                    </div>
                </div>
              @endforeach()
          </div>
        </div>

      </div>
    </div>
  </div>

@stop
