@extends('bwo::layouts.master')

@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/offer-banner.jpg')}}')">
      <div class="horizontal-inner-container">
          <h1>BONJOUR [PRÉNOM]</h1>
        </div>
      </div>
    </div>
    <div class="candidate-container">
      <div class="horizontal-inner-container">

        <div class="candidate-list">
          <ol class="breadcrumb">
            <li><a href="{{route('home')}}">ACCUEIL</a></li>
            <li><a href="{{route('candidate')}}">ESPACE CANDIDAT</a></li>
            <li>VOS INFORMATIONS</li>
          </ol>

          <div>
            <h2>MODIFIER VOS INFORMATIONS</h2>
            <form>
              <div class="col-md-6">
                {!! Form::Label('surname', 'Prénom') !!}
                {!! Form::text('surname', '', ['class' => 'form-control']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('nom', 'Nom') !!}
                {!! Form::text('nom', '', ['class' => 'form-control']) !!}
              </div>
              <div class="col-md-12">
                {!! Form::Label('address', 'Adresse') !!}
                {!! Form::text('address', '', ['class' => 'form-control']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('postal_code', 'Code Postal') !!}
                {!! Form::text('postal_code', '', ['class' => 'form-control']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('city', 'Ville') !!}
                {!! Form::text('city', '', ['class' => 'form-control']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('phone', 'Teléphone') !!}
                {!! Form::text('phone', '', ['class' => 'form-control']) !!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('email', 'E-mail') !!}
                {!! Form::text('email', '', ['class' => 'form-control']) !!}
              </div>
              <br clear="all">
              <div class="btn-red-container">
                <button type="submit" class="btn btn-red">ENREGISTER</button>
              </div>
            </form>
          </div>

          <br clear="all">
        </div>
      </div>
    </div>
    <div class="three-colors-separator">
      <div class="separator-piece dark-gray"></div>
      <div class="separator-piece soft-gray"></div>
      <div class="separator-piece red"></div>
    </div>
    <div class="offers-3-container candidate-page">
        @include('bwo::partials.three-offers')
    </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
@endpush


@push('javascripts')
	<script>

    $(document).ready(function() {
        $(document).on("click","#btn-more",function() {
          $(this).hide();
          $('#btn-less').show();
          $('.light-gray-search-container').show();
        });

        $(document).on("click","#btn-less",function() {
          $(this).hide();
          $('#btn-more').show();
          $('.light-gray-search-container').hide();
        });
        $(document).ready(function() {
            $(document).on("click",".btn-search",function() {
              $(this).closest('form').submit();
            });
        });
        $(document).ready(function() {
            $(document).on("click","#btn-filtres",function() {
              $(this).closest('form').submit();
            });
        });


    });

  </script>

@endpush
