@extends('architect::layouts.master')

@section('content')

<div id="content-form"
languages="{{ base64_encode(Modules\Architect\Entities\Language::all()) }}"
users="{{ $users ? base64_encode($users->toJson()) : null }}"
@if(isset($typology)) typology="{{base64_encode($typology->toJson())}}" @endif
@if(isset($content)) content="{{base64_encode($content->toJson())}}" @endif
></div>

@stop
