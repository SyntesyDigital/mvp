@extends('bwo::layouts.master', [
    'htmlTitle' => '',
    'metaDescription' => '',
    'pageTitle' => '',
    'searchBar' => true
])

@php
$fields = [
    [
        'name' => 'email',
        'placeholder' => 'Email'
    ],

    [
        'name' => 'firstname',
        'placeholder' => 'Prénom'
    ],


    [
        'name' => 'lastname',
        'placeholder' => 'Nom'
    ],

    [
        'name' => 'telephone',
        'placeholder' => 'Téléphone'
    ],

    [
        'name' => 'postal_code',
        'placeholder' => 'Code postal'
    ],

    [
        'name' => 'location',
        'placeholder' => 'Ville'
    ],
];
@endphp

@section('content')
<div class="row">
    <div class="col-md-offset-3 col-md-6">

        <h3>Enregistrement de votre compte</h3>

        {!!
            Form::open([
                'url' => route('linkedin.create'),
                'method' => 'POST'
            ])
        !!}


        {!!
            Form::hidden('linkedin_id', isset($linkedin['id']) ? $linkedin['id'] : null)
        !!}

            @foreach($fields as $field)
                <div class="form-group">
                    @php
                        $value = isset($linkedin[$field["name"]]) ? $linkedin[$field["name"]] : null;
                    @endphp

                    {!!
                        Form::text(
                            $field["name"],
                            old($field["name"], $value),
                            [
                                'placeholder' => isset($field["placeholder"]) ? $field["placeholder"] : null,
                                'class' => 'form-control'
                            ]
                        )
                    !!}

                    @if ($errors->has($field["name"]))
                      <p class="control-label error-login-p">{{ $errors->first($field["name"]) }}</p>
                    @endif
                </div>
            @endforeach

            {!!
                Form::submit('Enregistrer mon compte', [
                    'class' => 'btn btn-dark-gray full-width'
                ])
            !!}

        {!! Form::close() !!}
    </div>
</div>

<br clear="all">
@endsection

@push('javascripts')
@endpush
