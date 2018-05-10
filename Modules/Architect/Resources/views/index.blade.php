@extends('architect::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('architect.name') !!}
    </p>

    <p>
        This is test :

        <form action="{{route('save')}}" method="POST">
            <input type="hidden" name="typology_id" value="1" />

            @php
                $typology = Modules\Architect\Entities\Typology::find(1);
            @endphp

            @foreach($typology->fields as $field)
                <input type="text" name="{{$field->identifier}}" value="" placeholder="{{$field->name}}" />
            @endforeach

            <input type="submit" />
        </form>
    </p>
@stop
