@extends('architect::layouts.master')

@section('content')
<div class="container grid-page">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1>{{Lang::get('architect::settings.title')}}</h1>
        <h3>{{Lang::get('architect::settings.subtitle')}}</h3>
      </div>

      <div class="grid-items">
        <div class="row">

            <div class="col-xs-3">
                <a href="{{route('users')}}">
                  <div class="grid-item">
                      <i class="fa fa-users"></i>
                      <p class="grid-item-name">
                          {{Lang::get('architect::settings.users')}}
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="{{route('languages')}}">
                  <div class="grid-item">
                      <i class="fa fa-flag"></i>
                      <p class="grid-item-name">
                          {{Lang::get('architect::settings.languages')}}
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="{{route('translations')}}">
                  <div class="grid-item">
                      <i class="fa fa-list-alt"></i>
                      <p class="grid-item-name">
                          {{Lang::get('architect::settings.translations')}}
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="{{route('menu.index')}}">
                  <div class="grid-item">
                      <i class="fa fa-list"></i>
                      <p class="grid-item-name">
                          {{Lang::get('architect::settings.menu')}}
                      </p>
                  </div>
                </a>
            </div>

            <div class="col-xs-3">
                <a href="{{route('pagelayouts')}}">
                  <div class="grid-item">
                      <i class="fa fa-columns"></i>
                      <p class="grid-item-name">
                          {{Lang::get('architect::settings.templates')}}
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
