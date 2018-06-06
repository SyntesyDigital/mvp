@extends('architect::layouts.master')

@section('content')

<div id="content-form"
users="{{ $users ? base64_encode($users->toJson()) : null }}"
@if(isset($typology))typology="{{base64_encode($typology->toJson())}}"@endif
></div>

@stop
