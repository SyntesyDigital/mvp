@extends('architect::layouts.master')

@section('content')
<div class="container grid-page">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1>Configuració</h1>
        <h3>Configura les diferents opcions del portal web</h3>
      </div>

      <div class="grid-items">
        <div class="row">

            <div class="col-xs-3">
                <a href="{{route('users')}}">
                  <div class="grid-item">
                      <i class="fa fa-users"></i>
                      <p class="grid-item-name">
                          Usuaris
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="">
                  <div class="grid-item">
                      <i class="fa fa-flag"></i>
                      <p class="grid-item-name">
                          Llenguatges
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="">
                  <div class="grid-item">
                      <i class="fa fa-list-alt"></i>
                      <p class="grid-item-name">
                          Traduccions
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="">
                  <div class="grid-item">
                      <i class="fa fa-list"></i>
                      <p class="grid-item-name">
                          Menú
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="">
                  <div class="grid-item">
                      <i class="fa fa-columns"></i>
                      <p class="grid-item-name">
                          Plantilles
                      </p>
                  </div>
                </a>
            </div>


        </div>
      </div>

    </div>
  </div>
</div>


@stop
