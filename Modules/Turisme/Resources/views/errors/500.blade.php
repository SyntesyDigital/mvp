@extends('turisme::layouts.app',[
  "title" => null
])

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-md-offset-1 col-md-10">
          <h1>{{Lang::get('turisme::messages.page_not_found_title')}}</h1>
          <p>
            {{sprintf(Lang::get('turisme::messages.page_not_found'),Request::url())}}
          </p>
        </div>
      </div>
    </div>
@endsection
