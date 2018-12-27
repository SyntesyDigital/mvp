@extends('architect::layouts.master')

@section('content')

{!!
    Form::open([
        'url' => isset($template)
            ? route('rrhh.admin.emailstemplates.update', $template)
            : route('rrhh.admin.emailstemplates.store'),
        'method' => 'POST'
    ])
!!}

<input type="hidden" name="id" value="{{ $template->id or '' }}" />
<input type="hidden" name="_method" value="{{ isset($template) ? 'PUT' : 'POST' }}">

<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('rrhh.admin.emailstemplates.index')}}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> {{ Lang::get('rrhh::settings.emailstemplates') }}
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
      <div class="card-body jsonbuilder">
        <div class="form-group {{$errors->has("subject") ? 'has-error' : ''}}">
            <label>Sujet</label>
            {!!
                Form::text(
                    'subject',
                    isset($template) ? $template->subject : null,
                    [
                        'class' => 'form-control'
                    ]
                )
            !!}
        </div>

        <div class="form-group {{$errors->has("body") ? 'has-error' : ''}}">
            <label>Corps du mail</label>
            {!!
                Form::textarea(
                    'body',
                    isset($template) ? $template->body : null,
                    [
                        'class' => 'form-control'
                    ]
                )
            !!}
        </div>
      </div>
    </div>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <h3>Modèle d'email</h3>
        <div class="form-group {{$errors->has("identifier") ? 'has-error' : ''}}">
        {!!
            Form::select('identifier', config('emails_templates'),isset($template) ? $template->identifier : null, [
                'class' => 'form-control',
                'placeholder' => '---'
            ])
        !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection
