@extends('architect::layouts.master')

@section('content')

  <div id="typology-form" @if($typology)typology={{base64_encode($typology->toJson())}}@endif></div>

@stop
