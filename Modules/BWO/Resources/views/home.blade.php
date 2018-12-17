@extends('bwo::layouts.master', [
  'htmlTitle' => '',
  'metaDescription' => '',
  'headerDiv' => 'home-header'
])

@section('content')
  <div class="banner home-banner" style="background-image:url('{{asset('modules/bwo/images/home-banner.jpg')}}')">
    <div class="horizontal-inner-container">

      <div class="banner-info-container">
        <div class="banner-title">
            <h2 class="gray-square-text">LA BONNE PERSONNE C'EST PEUT ÊTRE</h2>
            <div class="extra-red-text">VOUS !</div>
        </div>

        <form method="get" action="{{route('search')}}">
          <input class="form-control input-round search-input" type="text" placeholder="Métier, ville, contrat..." name="search" value="">

          <div class="btn btn-red btn-search">
            <i class="fa fa-search"></i>RECHERCHER
          </div>
          <a href="{{route('search')}}">
            <div class="btn btn-red">
              <i class="fa fa-list"></i>TOUTES NOS OFFRES
            </div>
          </a>
        </form>
      </div>
    </div>

  </div>
  <div class="three-offers-container">
    <div class="horizontal-inner-container">
      @foreach($offers as $offer)
        <div class="col-md-4 offer-box-left">
          <div class="offer-box">
              <div class="title">
                {{ $offer->title }}
              </div>
              <p>Réf: BOU - Posté le 16/11/2018</p>
              <div class="buttons">
                <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
              </div>
              <a href="{{route('offer.show', [
                'job_1' => str_slug(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_1, 'jobs1'), '-'),
              ])}}" class="detail" >DÉTAIL DE L'OFFRE</a>
          </div>
        </div>
      @endforeach

        <br clear="all">
    </div>
  </div>


  <div class="gray-information-container">
    <div class="horizontal-inner-container">
      <div class="col-md-6 home-square home-square-logo">
        <div class="img-bwo" style="background-image:url('{{asset('modules/bwo/images/home-bwo.jpg')}}')"></div>

      </div>
      <div class="col-md-6 home-square p-l-10">
        <h2 class="gray-square-text">VOTRE AGENCE D'EMPLOI TERTIAIRE À PARIS</h2>
        <p class=subtitle>Conseil en recrutement intérim, CDD, CDI depuis 1968</p>
        <p>Bienvenue sur le site BWO. Installée à Paris 12e, notre agence pour l'emploi est spécialisée dans les offres du secteur tertiare. Assistanat, secrétariat, comptabilité, contrôle de gestion... nos offres d'emploi concernent aussi bien des missions d'intérim que des recrutements en CDD et CDI sur Paris (75) et la petite couronne (92, 93 et 94).</p>
        <p>Spécilistes en ressources humaines nous engageons la même énergie pour les enterprises queles candidats.</p>
      </div>
      <br clear="all">
    </div>
  </div>
  <div class="doble-bk-information-container">
      <div class="horizontal-inner-container">
        <div class="col-md-6 home-square home-square-white">
          <h2 class="gray-square-text">INFORMATION SUR L'INTÉRIM</h2>

          <div id="last-news"></div>

        </div>
        <div class="col-md-6 home-square home-square-gray p-l-10">
          <h2 class="gray-square-text">CANDIDATURE SPONTANÉE</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vehicula at libero at ornare. Nunc at iaculis nisi, porta dapibus dolor. Pellentesque bibendum eget lorem quis placerat. Suspendisse vestibulum sapien nibh, et lobortis libero laoreet nec. Ut eget ex ante. Mauris cursus nibh ac augue tincidunt, nec ultrices elit ullamcorper. Aenean in metus nunc. Vestibulum ac auctor dolor, sit amet lacinia orci. Proin at est velit.</p>
          <div class="centered">
            <a href="{{route('spontanious.form')}}" class="btn btn-dark-gray" ><i class="fa fa-pencil"></i>ENVOYER UNE CANDIDATURE</a>
          </div>
        </div>
        <br clear="all">
      </div>
  </div>

  @endsection

  @push('javascripts')
    <script>
      routes = {"categoryNews" : "{{route('blog.category.index' ,['slug' => ':slug'])}}",
              "tagNews"      : "{{route('blog.tag.index' ,['slug' => ':slug'])}}" };
      $(document).ready(function() {
          $(document).on("click",".btn-search",function() {
            $(this).closest('form').submit();
          });


      });

    </script>

  @endpush
