@extends('architect::layouts.master')

@section('content')

    <div class="col-xs-offset-2 col-xs-10 page-content">

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

        {!!
            Form::open([
                'url' => isset($category) ? route('categories.update', $category) : route('categories.store'),
                'method' => 'POST',
            ])
        !!}

        @if(isset($category))
            {!! Form::hidden('_method', 'PUT') !!}
        @endif

        <div class="field-group">

            @foreach(Modules\Architect\Entities\Category::FIELDS as $field)
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
                                            <label className="bmd-label-floating">{{ $field['name'] }} - {{ $language->name }}</label>
                                            @php
                                                $fieldName = "fields[" . $field['name'] . "][" . $language->id . "]";
                                            @endphp
                                            {!!
                                                Form::text(
                                                    $fieldName,
                                                    isset($category) ? $category->getFieldValue($field['identifier'], $language->id) : old($fieldName),
                                                    [
                                                        'class' => 'form-control'
                                                    ]
                                                )
                                            !!}
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
                                            <label className="bmd-label-floating">{{ $field['name'] }} - {{ $language->name }}</label>
                                            @php
                                                $fieldName = "fields[" . $field['name'] . "][" . $language->id . "]";
                                            @endphp
                                            {!!
                                                Form::textarea(
                                                    $fieldName,
                                                    isset($category) ? $category->getFieldValue($field['identifier'], $language->id) : old($fieldName),
                                                    [
                                                        'class' => 'form-control'
                                                    ]
                                                )
                                            !!}
                                        </div>
                                    @endforeach()
                                </div>
                            </div>
                        </div>
                    @break

                @endswitch
            @endforeach()

            <div className="field-item">
                <button id="heading" className="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                    <span className="field-type">
                        <i className="fa fa-font"></i> Category
                    </span>
                    <span className="field-name">
                        Category
                    </span>
                </button>

                <div id="collapse-category" className="collapse in" aria-labelledby="heading-collapse" aria-expanded="true" aria-controls="collapse-collapse">
                    <div className="field-form">
                        @php
                            $categories = Modules\Architect\Entities\Category::all()->pluck('name', 'id');
                            if(isset($category)) {
                                $categories->forget($category->id);
                            }
                        @endphp

                        {!!
                            Form::select(
                                'parent_id',
                                $categories,
                                isset($category) ? $category->parent_id : null,
                                [
                                    'class' => 'form-control'
                                ]
                            )
                        !!}
                    </div>
                </div>
            </div>

            {!!
                Form::submit('Save', [
                    'class' => 'btn btn-primary'
                ])
            !!}
        </div>

    {!! Form::close() !!}
    </div>
@stop

@push('javascripts-libs')
@endpush
