@extends('architect::layouts.master')

@section('content')

<div class="container leftbar-page">

  <div class="sidebar">
    <ul>
      <li class="active">
        <a href="" > <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
    </ul>
    <hr />
    <ul>
      @foreach($typologies as $typology)
          <li>
            <a href="{{route('contents', ['typology_id' => $typology->id])}}"><i class="fa {{$typology->icon}}"></i><span class="text">{{$typology->name}}</span> </a>
          </li>
      @endforeach()
    </ul>
    <hr/>
    <ul>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
    </ul>

  </div>

  <div class="col-xs-offset-2 col-xs-10 page-content">

    <h3 class="card-title">Continguts</h3>
    <a href="{{route('contents.show')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir contingut</a>

  </div>

</div>

@stop
