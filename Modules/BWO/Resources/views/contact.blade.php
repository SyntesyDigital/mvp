@extends('bwo::layouts.master')

@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/offer-banner.jpg')}}')">
      <div class="horizontal-inner-container">
          <h1>CONTACTEZ-NOUS</h1>
        </div>
      </div>
    </div>
    <div class="candidate-container">
      <div class="horizontal-inner-container">

        <div class="candidate-list">
          <ol class="breadcrumb">
            <li><a href="{{route('home')}}">ACCUEIL</a></li>
            <li>CONTACTEZ-NOUS</li>
          </ol>

          <div>
            <h2>CONTACTEZ-NOUS</h2>

            @if(Session::has('notify_success'))
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                    {{Session::get('notify_success')}}
                  </div>
                </div>
              </div>
            @endif

            @if(Session::has('notify_error'))
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-error">
                    {{Session::get('notify_error')}}
                  </div>
                </div>
              </div>
            @endif

            @if ($errors->any())
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
              </div>
            @endif


            {!!
  			        Form::open([
  			            'url' => route('contact.send'),
  			            'method' => 'POST'
  			        ])
  			    !!}
              <div class="col-md-6">
                {!! Form::Label('surname', 'Prénom') !!}
                {!!
                  Form::text('lastname', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Prénom'
                  ])
                !!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('nom', 'Nom') !!}
                {!!
  								Form::text('name', null, [
  									'class' => 'form-control',
  									'placeholder' => 'Nom'
  								])
  							!!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('email', 'E-mail') !!}
                {!!
  								Form::text('email', null, [
  									'class' => 'form-control',
  									'placeholder' => 'E-mail'
  								])
  							!!}
              </div>
              <div class="col-md-6">
                {!! Form::Label('subject', 'Sujet') !!}
                {!!
  								Form::text('subject', null, [
  									'class' => 'form-control',
  									'placeholder' => 'Sujet'
  								])
  							!!}
              </div>
              <div class="col-md-12">
                {!! Form::Label('message', 'Message') !!}
                {!!
  								Form::textarea('message', null, [
  									'class' => 'form-control',
  									'placeholder' => 'Message...'
  								])
  							!!}
              </div>
              <br clear="all">
              <div class="btn-red-container">
                {!!
  								Form::submit('ENVOYER', [
  									'class' => 'btn btn-red'
  								])
  							!!}
              </div>
            {{ Form::close()}}
          </div>

          <br clear="all">
        </div>
      </div>
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
