@extends('architect::layouts.master')

@push('stylesheets')
	{!! Html::style('/css/bootstrap-tagsinput.css') !!}
@endpush

@section('content')

{!!
    Form::open([
        'url' => isset($tag)
            ? route('rrhh.admin.tags.update', $tag)
            : route('rrhh.admin.tags.store'),
        'method' => 'POST'
    ])
!!}

{{ Form::hidden('id', isset($tag) ? $tag->id : null) }}
{{ Form::hidden('_method', isset($tag) ? 'PUT' : 'POST') }}

<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('rrhh.admin.tags.index')}}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> Tag {{ isset($tag) ? $tag->name : null }}
                </h1>

                <div class="float-buttons pull-right">
                    {!!
                        Form::submit(Lang::get('architect::fields.save'), [
                            'class' => 'btn btn-primary'
                        ])
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container rightbar-page">

    {{-- RIGHT COLUMN --}}
      <div class="col-md-9 page-content">
		  <div class="form-group {{$errors->has("name") ? 'has-error' : ''}}">
			 {!! Form::label('name', 'Nom') !!}
             {!!
                 Form::text('name', isset($tag) ? $tag->name : null, [
                     'class' => 'form-control',
                     'id' => 'name',
                 ])
             !!}
          </div>
      </div>

  {{-- SIDEBAR --}}
      <div class="sidebar">

      </div>

</div>

@endsection
