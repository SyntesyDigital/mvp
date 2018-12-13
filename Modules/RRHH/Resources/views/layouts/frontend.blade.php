<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{!! $htmlTitle or 'Agence d\'emploi Menco : recrutement intérim, CDD et CDI' !!}</title>
        <meta name="description" content="{!! $metaDescription or '' !!}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:title" content="{!! $htmlTitle or 'Menco RH' !!}"/>
        <meta property="og:description" content="{!! $socialDescription or '' !!}"/>
        <meta property="og:image" content="{!! $socialImage or asset('images/header-logo.jpg') !!}"/>
        <meta property="og:type" content="website"/>
        <link rel="stylesheet" media="all" href="{{ asset('css/font-awesome/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" media="all" href="{{ asset('plugins/toastr/toastr.min.css')}}" />
        <link rel="stylesheet" media="all" href="{{ asset('fonts/iconmoon/iconmoon.css')}}" />
        @stack('stylesheets')
        <link rel="stylesheet" media="all" href="{{ asset('css/frontend-style.css')}}" />
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
		<!-- Toastr -->
        <script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>
        <!-- Bootbox -->
        <script src="{{ asset('/plugins/bootbox/bootbox.min.js') }}"></script>
        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="/js/app.js"></script>
        <!-- Dialog -->
        <script src="{{ asset('js/libs/dialog.js')}}"></script>
    </head>
    <!-- Matomo -->
    <script type="text/javascript">
      var _paq = _paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//stats.menco-rh.fr/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Matomo Code -->
    <body>

    	@yield('modal')

		<section id="wrapper">
			<section id="main">
                <header>
                  <!--  home header -->
                  <div class="white-bar-header">
                    <div class="logo">
                        <a href="/"><img src="{{asset('images/header-logo.jpg')}}" alt="Menco recrutement intérim, CDD et CDI" /></a>
                    </div>
                    <div class="right-header-menu-div">

                      <div class="login-form ">
                        @if (Auth::check())
                              <form class="screen-form">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-title-content">
                                      <a href="{{route ('candidate.index')}}"><p class="form-title">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</p></a>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 text-center">

                                      @if(Auth::user()->hasRole(['admin', 'recruiter']))
                                          <a href="{{ route('admin.index') }}" class="btn">Admin</a>
                                      @endif

                                      @if(Auth::user()->hasRole(['candidate']))
                                          <a href="{{ route('candidate.index') }}" class="btn">Mon espace</a>
                                      @endif
                                    <a href="{{ route('logout') }}" class="btn" style="font-size: 13px;">Se déconnecter</a>
                                  </div>
                                </div>
                              </form>
                        @else
                              <form  class="screen-form" role="form" method="POST" action="{{ route('login') }}">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                  <div class="col-sm-12 m-bot-10">
                                      <input type="text" name="email" value="" placeholder="Identifiant" class="form-control" />
                                   </div>
                                  <div class="col-sm-12 m-bot-10">
                                      <input type="password" name="password" value="" placeholder="Mot de passe" class="form-control" />
                                  </div>
                                  <div class="col-sm-12">
                                    <input type="submit" class="btn" value="Se connecter" style="margin-left:0px;" />
                                  </div>

                                </div>
                              </form>
                        @endif
                        @if (!Auth::check() && (isset($errors)) &&($errors->has('email') || $errors->has('password')))
                          <div class="dropdown-login-error">
                              @if ((isset($errors)) && $errors->has('email'))
                                <p>{{ $errors->first('email') }}</p>
                                <p><a href="/password/reset">Recupérer mon mot de passe</a></p>
                              @endif
                              @if ((isset($errors)) &&  $errors->has('password'))
                                <p>{{ $errors->first('password') }}</p>
                              @endif
                          </div>
                        @endif
                          <nav class="navbar navbar-login-header">
                            <div class="navbar-header navbar-right">
                              <button id="user-nav-btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-login-sections" aria-expanded="false">
                                <i class="fa fa-user"></i>
                              </button>
                            </div>


                          </nav>
                      </div>
                      <div class="menu-header">
                        <nav class="navbar navbar-default navbar-menu-header">
                          <div class="navbar-header">
                            <button id="menu-button" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-header-sections" aria-expanded="false">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                          </div>
                          <div class="collapse navbar-collapse">
                            <ul>

                              <li {{{ (Request::is('*offers*') ? 'class=active' : '') }}}>
                                <a href="{{route('search')}}">
                                  <span class="link-content">
                                    OFFRES
                                  </span>
                                </a>
                              </li>

                              <li>
                                <a href="{{route('blog.index')}}">
                                  <span class="link-content">
                                    ACTUALITÉS
                                  </span>
                                </a>
                              </li>

                              <li {{{ (Request::is('agences') ? 'class=active' : '') }}}>
                                <a href="#" class="menu-dropdown">
                                  <span class="link-content">
                                    AGENCES
                                  </span>
                                </a>
                                @php
                                    $agences_all = App\Models\Agence::get();
                                @endphp
                                <div class="dropdown-content auto-height">
                                    @foreach($agences_all as $a)
                                          <a href="{{route('agences.page', $a->slug)}}">{{ $a->name }}</a>
                                    @endforeach
                                </div>
                              </li>


                              <li>
                                <a href="#" class="menu-dropdown">
                                  <span class="link-content">
                                    ENTREPRISES
                                  </span>
                                </a>
                                @php
                                    $typology = App\Models\Content\Typology::byIdentifier('entreprise_content')->first();
                                @endphp
                                @if($typology != null)
                                  @php
                                      $contents = $typology->contents()->where('status', 1)->get();
                                  @endphp
                                  <div class="dropdown-content auto-height">
                                      @foreach($contents as $c)
                                            <a href="{{route('entreprise.page', $c->getFieldValue('slug') )}}">{{$c->getFieldValue('title')}}</a>
                                      @endforeach()
                                  </div>
                                @endif
                              </li>
                              <li>
                                <a href="/nos-valeurs.html">
                                  <span class="link-content">
                                    NOS VALEURS
                                  </span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </nav>
                      </div>
                      <div class="collapse navbar-collapse" id="navbar-header-sections">
                            <ul>

                              <li {{{ (Request::is('*offers*') ? 'class=active' : '') }}}>
                                <a href="{{route('search')}}">
                                  <span class="link-content">
                                    OFFRES
                                  </span>
                                </a>
                              </li>

                              <li>
                                <a href="{{route('blog.index')}}">
                                  <span class="link-content">
                                    ACTUALITÉS
                                  </span>
                                </a>
                              </li>

                              <li {{{ (Request::is('agences') ? 'class=active' : '') }}}>
                                <a href="#" class="menu-dropdown">
                                  <span class="link-content">
                                    AGENCES
                                  </span>
                                </a>
                                @php
                                    $agences_all = App\Models\Agence::get();
                                @endphp
                                <div class="dropdown-content auto-height">
                                    @foreach($agences_all as $a)
                                          <a href="{{route('agences.page', $a->slug)}}">{{ $a->name }}</a>
                                    @endforeach
                                </div>
                              </li>


                              <li>
                                <a href="#" class="">
                                  <span class="link-content">
                                    ENTREPRISES
                                  </span>
                                </a>
                              </li>

                              <li {{{ (Request::is('contact') ? 'class=active' : '') }}}>
                                <a href="{{ route('contact.index')}}">
                                  <span class="link-content">
                                    CANDIDAT
                                  </span>
                                </a>
                              </li>

                            </ul>
                      </div>
                      <div class="collapse navbar-collapse" id="navbar-login-sections">
                        @if (Auth::check())
                          <div class="login-form-dropdown">
                              <form>
                                <div class="row">
                                  <div class="form-title-content">
                                    <p class="form-title">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</p>
                                  </div>
                                </div>
                                <div class="row row-buttons">
                                  @if(Auth::user()->hasRole(['admin', 'recruiter']))
                                      <a href="{{ route('admin.index') }}" id="btn-space" class="btn">Admin</a>
                                  @endif

                                  @if(Auth::user()->hasRole(['candidate']))
                                      <a href="{{ route('candidate.index') }}" id="btn-space" class="btn">Mon espace</a>
                                  @endif
                                  <a href="{{ route('logout') }}" id="btn-logout" class="btn">Se déconnecter</a>
                                </div>
                              </form>
                          </div>
                        @else
                          <div class="login-form-dropdown">
                              <form role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="text" name="email" value="" placeholder="Identifiant" class="form-control" />
                                    @if ((isset($errors)) && $errors->has('email'))
                                      <p class="control-label error-login-p">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="row">
                                    <input type="password" name="password" value="" placeholder="Mot de passe" class="form-control" />
                                    @if ((isset($errors)) && $errors->has('password'))
                                      <p class="control-label error-login-p">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="row row-buttons">
                                    <a href="/password/reset">Mot de passe oublié ?</a>
                                    <br cloear="all">
                                    <input type="submit" class="btn" value="Se connecter" style="margin-left:0px;" />
                                </div>
                              </form>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  @if(isset($headerDiv) && $headerDiv == 'home-header')
                    <div class="header-div home-header" style="background-image:url('{{asset('images/home-banner.jpg')}}')">

                        <div class="horizontal-inner-container" style="padding:0px;">
                            <div class="row">
                              <div class="search-form">
                                <form role="form" method="GET" id="search-form" action="{{ route('search') }}">
                                  <div class="search-input">

                                    <input type="text"  placeholder="Métier, ville, contrat..." name="search" value="{{ isset($search)?$search:''}}" />
                                  @if ((isset($errors)) && $errors->has('search'))
                                          <p class="control-label error-login-p">{{ $errors->first('search') }}</p>
                                        @endif
                                    <div class="submit-btn-container" >
                                      <i class="fa fa-search"></i>
                                      <input type="submit" value="RECHERCHER" class="btn" />
                                    </div>

                                  </div>
                                </form>
                              </div><!-- end search form -->
                            </div>

                        </div>

                          <div class="header-text">
                            <p>
                              Choisissez un véritable <span>expert</span>
                            </p>
                          </div>
                        <div class="red-arc" style="background-image:url('{{asset('images/red-arc.png')}}')">
                        </div>

                      <!-- end home header -->
                    </div>
                  @else
                    @if(!isset($headerImg))
                      @php
                        $headerImg = '';
                      @endphp
                    @endif
                    <div class="header-div {{isset($searchBar)?'search':''}}" style="background-image:url('{{$headerImg}}')">
                        <div class="semitransparent-layer">
                        </div>
                        <div class="horizontal-inner-container">
                            <div class="header-text">
                              <h1>{{ $pageTitle or '' }}</h1>
                              @if(isset($headerDescription))
                                <p>{{$headerDescription}}</p>
                              @endif

                              @if(isset($headerDate))
                                @php
                                  $timestamp = strpos($headerDate, '-')
                                    ? strtotime($headerDate)
                                    : strtotime(Carbon\Carbon::createFromFormat('d/m/Y', $headerDate));

                                  $date = new Jenssegers\Date\Date($timestamp);
                                  $date->setlocale('fr');
                                @endphp
                                <p class="date-header">Publié le {{  $date->format('d F Y') }} </p>
                              @endif
                            </div>
                            @if(isset($searchBar))

                              <div class="row" >
                                <div class="search-form">
                                  <form role="form" method="GET" id="search-form" action="{{ route('search') }}" class="left-form">
                                    <div class="search-input">

                                      <input type="text"  placeholder="Métier, ville, contrat..." name="search" value="{{ isset($search)?$search:''}}" />
                                    @if ((isset($errors)) && $errors->has('search'))
                                            <p class="control-label error-login-p">{{ $errors->first('search') }}</p>
                                          @endif
                                      <div class="submit-btn-container" >
                                        <i class="fa fa-search"></i>
                                        <input type="submit" value="RECHERCHER" class="btn" />
                                      </div>

                                    </div>
                                    <br clear="all">
                                    <!--div class="search-options">
                                       {!!
                                          Form::siteList('contracts', 'contract', isset($contract)?$contract:null, [
                                              'class' => 'form-control css-checkbox',
                                              'placeholder' => '---'
                                          ], 'inline-checkbox')
                                        !!}

                                        @if ((isset($errors)) && $errors->has('contract'))
                                          <p class="control-label error-login-p">{{ $errors->first('contract') }}</p>
                                        @endif
                                    </div-->



                                    <button id="filter-nav-btn"  class="btn btn-secondary-clear " >Voir plus de filtres</button>

                                    <div class="filter-container" id="navbar-filter-sections" style="display:none">
                                        <div class="filter-form-dropdown">
                                            <div class="col-md-4">
                                              <p>Choissisez votre agence</p>
                                              <div class="multiselect">
                                                <div class="selectBox" onclick="showCheckboxes(1)">
                                                  <select class="form-control">
                                                    <option>----</option>
                                                  </select>
                                                  <div class="overSelect"></div>
                                                </div>
                                                <div class="checkboxes" id="checkboxes_1">
                                                  @foreach($agences_all as $a)
                                                    <label for="agence_{{$a->id}}"><input type="checkbox" value="{{$a->id}}" name="agence[]" id="agence_{{$a->id}}" {{in_array($a->id,$selected_agence)?'checked="checked"':''}} />{{$a->name}}</label>
                                                  @endforeach
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-4">
                                              <p>Choissisez votre métier</p>
                                              <div class="multiselect">
                                                <div class="selectBox" onclick="showCheckboxes(2)">
                                                  <select class="form-control">
                                                    <option>----</option>
                                                  </select>
                                                  <div class="overSelect"></div>
                                                </div>
                                                <div class="checkboxes" id="checkboxes_2">
                                                  @php
                                                    $list = Modules\RRHH\Entities\Tools\SiteList::where('identifier', 'jobs1')->first();
                                                    $jobs = collect(json_decode($list->value, true))->mapWithKeys(function ($item, $key) {
                                                        return [$item['value'] => $item['name']];
                                                    });
                                                    $jobs = $jobs->toArray();
                                                  @endphp
                                                  @foreach($jobs as $key => $value)
                                                    <label for="job_{{$key}}"><input type="checkbox" value="{{$key}}" name="job[]" id="job_{{$key}}" {{in_array($key,$selected_job)?'checked="checked"':''}} />{{$value}}</label>
                                                  @endforeach
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-4">
                                              <p>Choissisez votre type de contrat</p>
                                              <div class="multiselect">
                                                <div class="selectBox" onclick="showCheckboxes(3)">
                                                  <select class="form-control">
                                                    <option>----</option>
                                                  </select>
                                                  <div class="overSelect"></div>
                                                </div>
                                                <div class="checkboxes" id="checkboxes_3">
                                                  @php
                                                    $list = Modules\RRHH\Entities\Tools\SiteList::where('identifier', 'contracts')->first();
                                                    $contracts = collect(json_decode($list->value, true))->mapWithKeys(function ($item, $key) {
                                                        return [$item['value'] => $item['name']];
                                                    });
                                                    $contracts = $contracts->toArray();
                                                  @endphp
                                                  @foreach($contracts as $key => $value)
                                                    <label for="contract_{{$key}}"><input type="checkbox" value="{{$key}}" name="contract[]" id="contract_{{$key}}" {{in_array($key,$selected_contract)?'checked="checked"':''}}  />{{$value}}</label>
                                                  @endforeach
                                                </div>
                                              </div>
                                            </div>

                                            <div class="col-md-12">
                                              <button class="btn">APPLIQUER LES FILTRES</button>
                                            </div>
                                            <br clear="all">
                                        </div>
                                    </div>

                                  </form>

                                </div><!-- end search form -->
                              </div>
                            @endif
                                                                        <br clear="all">

                        </div>

                                                                      <br clear="all">

                        <div class="red-arc" style="background-image:url('{{asset('images/red-arc.png')}}')">
                        </div>

                      <!-- end home header -->
                    </div>
                  @endif

                </header>


                <section id="content">

                    {{-- @if(isset($errors))
                        @if ($errors->any())
                          <div class="alert alert-danger">
                              @foreach ($errors->all() as $error)
                                  <p>{{ $error }}</p>
                              @endforeach
                          </div>
                      @endif
                    @endif --}}

                    @yield('content')
                </section>
	      </section>
    </section>

    <footer class="horizontal-container">
      <div class="horizontal-inner-container">
        <div class="row">
           <div class="footer-logo">
              <img src="{{asset('images/footer-logo.jpg')}}" alt="Menco" />
              <div class="footer-social">
                  <a href="https://www.facebook.com/menco.groupe/" ><i class="fa fa-facebook"></i></a>
                  <a href="https://www.linkedin.com/company-beta/11191903"><i class="fa fa-linkedin"></i></a>
                  <a href="http://www.viadeo.com/fr/company/menco-interim"><i class="fa fa-viadeo"></i></a>
              </div>
            </div>
            <div class="footer-right">
              <div class="row">
                  <div class="col-md-2 col-md-offset-1"> <p>> <a href="{{route('blog.index')}}">Actualités</a></p></div>
                  <div class="col-md-2"><p>> <a href="{{route('contact.index')}}">Contacts</a></p></div>
                  <div class="col-md-2"><p>><a href="/nos-valeurs.html">Nos valeurs</a></p></div>
                  <div class="col-md-2"><p>> <a href="{{route('spontanious.form')}}">Déposer votre CV</a></p></div>
                  <div class="col-md-2"><p>> <a href="/liens-utiles.html">Liens utiles</a></p></div>
              </div>
                <div class="red-line"></div>
                <div class="agences">
                  <h2>Nos agences pour l'emploi</h2>
                  <p class="red">
                    @php
                      $first_agence = true;
                    @endphp
                    @foreach($agences_all as $a)
                        @if($first_agence)
                            @php $first_agence = false;  @endphp
                            <a href="{{route('agences.page', $a->slug)}}">{{ $a->name }}</a>
                        @else
                            {{ ' - '}} <a href="{{route('agences.page', $a->slug)}}">{{ $a->name }}</a>
                        @endif
                    @endforeach
                  </p>
                </div>
            </div>
        </div>
      </div>
      <div class="col-sm-12 footer-red-bk">
        <p>
          COPYRIGHT © MENCO @php echo @date('Y'); @endphp - <a href="/mentions-legales.html" rel="nofollow">INFOS LEGALES</a></p>
      </div>
    </footer>

		@stack('javascripts-libs')

    @if ((isset($errors)) &&($errors->has('email') || $errors->has('password')))
      <script>
        $(function(){
          setTimeout(function(){ $(".dropdown-login-error").fadeOut(); }, 8000);
        });
      </script>
    @endif

  		<script>
  			$(function(){
        var CSRF_TOKEN = "{{csrf_token()}}";
  				@if(Session::has('message'))
  				    var type = "{{ Session::get('alert-type', 'info') }}";
  				    switch(type){
  				        case 'info':
  				            toastr.info("{{ Session::get('message') }}", 'Info', {timeOut: 3000});
  				            break;
  				        case 'warning':
  				            toastr.warning("{{ Session::get('message') }}", 'Warning', {timeOut: 3000});
  				            break;
  				        case 'success':
  				            toastr.success("{{ Session::get('message') }}", 'Success', {timeOut: 3000});
  				            break;
  				        case 'error':
  				            toastr.error("{{ Session::get('message') }}", 'Error', {timeOut: 3000});
  				            break;
  				    }
  				  @endif
  			});
  		</script>
      <script src="{{ asset('/js/front/menu.js') }}"></script>

    @stack('javascripts')
    </body>

    @stack('modals')

</html>
