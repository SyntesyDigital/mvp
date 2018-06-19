@extends('architect::layouts.master')

@section('content')
    {!!
        Form::open([
            'url' => isset($tag) ? route('tags.update', $tag) : route('tags.store'),
            'method' => 'POST',
        ])
    !!}

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @if(isset($tag))
        {!! Form::hidden('_method', 'PUT') !!}
    @endif

    @foreach(Modules\Architect\Entities\Tag::FIELDS as $field)
        @switch($field["type"])
            @case('text')
                <div className="field-item">
                    <button id="heading" className="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                        <span className="field-type">
                            <i className="fa fa-font"></i> {{ ucfirst($field['type']) }}
                        </span>
                        <span className="field-name">
                            {{ $field['name'] }}
                        </span>
                    </button>

                    <div id="collapse{{ $field['identifier'] }}" className="collapse in" aria-labelledby="heading{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                        <div className="field-form">
                            @foreach(Modules\Architect\Entities\Language::all() as $language)
                                <div className='form-group bmd-form-group'>
                                    <label className="bmd-label-floating">{{ $field['name'] }} - {{ $language->iso }}</label>
                                    <input type="text" className="form-control" name="fields[{{ $field['identifier'] }}][{{ $language->id }}]" value="{{ isset($tag) ? $tag->getFieldValue($field['identifier'], $language->id) : null }}" />
                                </div>
                            @endforeach()
                        </div>
                    </div>
                </div>
            @break

            @case('richtext')
                <div className="field-item">
                    <button id="heading" className="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                        <span className="field-type">
                            <i className="fa fa-font"></i> {{ ucfirst($field['type']) }}
                        </span>
                        <span className="field-name">
                            {{ $field['name'] }}
                        </span>
                    </button>

                    <div id="collapse{{ $field['identifier'] }}" className="collapse in" aria-labelledby="heading{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                        <div className="field-form">
                            @foreach(Modules\Architect\Entities\Language::all() as $language)
                                <div className='form-group bmd-form-group'>
                                    <label className="bmd-label-floating">{{ $field['name'] }} - {{ $language->iso }}</label>
                                    <input type="text" className="form-control" name="fields[{{ $field['name'] }}][{{ $language->id }}]" value="{{ isset($tag) ? $tag->getFieldValue($field['identifier'], $language->id) : null }}" />
                                </div>
                            @endforeach()
                        </div>
                    </div>
                </div>
            @break

        @endswitch
    @endforeach()

    {!!
        Form::submit('Save', [
            'class' => 'btn'
        ])
    !!}

    {!! Form::close() !!}
@stop

@push('javascripts-libs')
@endpush
