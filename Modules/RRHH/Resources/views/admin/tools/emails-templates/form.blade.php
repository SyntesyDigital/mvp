@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
        {!!
            Form::open([
                'url' => isset($template)
                    ? route('admin.tools.emailstemplates.update', $template)
                    : route('admin.tools.emailstemplates.store'),
                'method' => 'POST'
            ])
        !!}

        <input type="hidden" name="id" value="{{ $template->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($template) ? 'PUT' : 'POST' }}">


        <div class="col-md-7 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Template</h3>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>

                    <div class="form-group">
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

                    <div class="form-group">
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


            <input value="Enregistrer" type="submit" class="btn btn-success pull-right" />
        </div>


        <!-- IDENTIFIER -->
        <div class="col-md-3" style="margin-bottom:30px;">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Identifiant</h3>
                    <h6 class="card-subtitle mb-2 text-muted">Obligatoire et alpha-numérique</h6>

                    <div class="form-group">
                        {!!
                            Form::text('identifier', isset($template) ? $template->identifier : null, [
                                'class' => 'form-control',
                                'placeholder' => 'Ex: template_1'
                            ])
                        !!}
                    </div>
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>

</div>
@endsection
