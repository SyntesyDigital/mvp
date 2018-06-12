@extends('architect::layouts.master')

@section('content')
    <div id="typology-form" @if((isset($typology)) && $typology)typology={{base64_encode($typology->toJson())}}@endif></div>
@stop
