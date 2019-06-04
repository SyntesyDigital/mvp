@extends('front::layouts.app')

@section('content')
    <div class="gray-information-container" style="min-height:500px;">
      <div class="horizontal-inner-container">
        <div class="col-md-6 home-square home-square-logo">
          <div class="img-front" style="background-image:url('{{asset('modules/front/images/home-front.jpg')}}')"></div>

        </div>
        <div class="col-md-6 home-square p-l-10">
          <h2 class="gray-square-text">ERREUR 404 - PAGE INTROUVABLE</h2>
          <p class=subtitle>LA PAGE QUE VOUS CHERCHEZ N'EXISTE PAS. <br /> NOUS VOUS PRIONS DE BIEN VOULOIR NOUS EN EXCUSER.</p>
          <p>
              <a href="/" class="btn btn-dark-gray">Accédez à la page d’accueil </a>
          </p>
        </div>
        <br clear="all">
      </div>
    </div>
@endsection