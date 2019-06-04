@extends('architect::layouts.master')

@section('content')
{!!
    Form::open([
        'url' => isset($element)
            ? route('extranet.elements.update', $element->id)
            : route('extranet.elements.store'),
        'method' => 'POST'
    ])
!!}

{{ Form::hidden('id', isset($element) ? $element->id : null) }}
{{ Form::hidden('_method', isset($element) ? 'PUT' : 'POST') }}

<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('extranet.elements.index')}}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="{{$model_icon}}"></i> {{$model_title}}
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


<div class="container rightbar-page sitelist">

    {{-- LEFT COLUMN --}}
      <div class="col-md-9 page-content">
          <div class="card-body jsonbuilder">
            <h3 class="card-title">Field List</h3>
          </div>
      </div>

  {{-- SIDEBAR --}}
      <div class="sidebar">

          <div class="form-group {{$errors->has("name") ? 'has-error' : ''}}">
              <label for="name">Name</label>
              {!!
                  Form::text('name', isset($element) ? $element->name : $model_title, [
                  /*    'oninput' => 'app.sitelist.updatePreview();',*/
                      'class' => 'form-control',
                      'id' => 'name'
                  ])
              !!}
          </div>

          <div class="form-group {{$errors->has("identifier") ? 'has-error' : ''}}">
             <label for="name">Identifiant</label>
             {!!
                 Form::text('identifier', isset($element) ? $element->identifier : null, [
                  /*   'oninput' => 'app.sitelist.updatePreview();',*/
                     'class' => 'form-control',
                     'id' => 'identifier',
                 ])
             !!}
          </div>        

          <hr />


      </div>

</div>


@endsection


@push('javascripts')

@endpush
