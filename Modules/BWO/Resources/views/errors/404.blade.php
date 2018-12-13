@extends('bwo::layouts.master',[
  "title" => null
])

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-md-offset-4 col-md-8">
          <h1>{{Lang::get('bwo::messages.page_not_found_title')}}</h1>
          <p>
            {{sprintf(Lang::get('bwo::messages.page_not_found'),Request::url())}}
          </p>
        </div>
      </div>
    </div>
@endsection
