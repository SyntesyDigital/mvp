<header>

    <div class="topnav">
        <div class="topnav-top">
            <div class="container">
                <div class="topbar-left">
                    <a href="/"><img src="{{asset('images/header-logo.jpg')}}" width="50%" height="50%"></a>
                </div>

                <div class="topbar-right">
                  <div class="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Bonjour, {{Auth::user()->firstname}}
                            <b class="caret"></b>
                            <div class="ripple-container"></div>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right default-padding">
                              <li class="dropdown-header"></li>
                              <li>
                                  <a href="{{ route('admin.account') }}">
                                    <i class="fa fa-user-circle-o"></i>
                                      &nbsp;Mon compte
                                  </a>
                              </li>
                              <li>
                                <a href=""
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      <i class="fa fa-sign-out"></i> &nbsp; Déconnexion
                                  </a>
                                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                      {{csrf_field()}}
                                  </form>
                                </li>
                            </ul>
                      </li>
                    </ul>
                  </div>
                </div>

            </div>
        </div>

        <div class="topnav-bottom">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">
                          Accueil
                      </a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('rrhh.admin.offers.index')}}">
                            Offres
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.applications.spontaneous')}}">
                            C. spontanées
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.applications.index')}}">
                            Candidatures
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.candidates.index')}}">
                            Candidats
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('admin'))
                      <li class="nav-item active">
                          <a class="nav-link" href="{{route('admin.customers.index')}}">
                              Clients
                          </a>
                      </li>
                    @endif

                    @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownContents" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Contenus
                      </a>
                      @php
                        $typologies = \App\Models\Content\Typology::where('display_menu', 1)->get();
                      @endphp
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownContents">
                        @foreach($typologies as $t)
                            <a class="dropdown-item" href="{{ route('admin.content.index.type', $t->identifier) }}">{{$t->name}}</a>
                        @endforeach()
                        <a class="nav-link" href="{{route('admin.agences.index')}}">Agences</a>
                        <hr>
                        <a class="dropdown-item" href="{{route('admin.content.medias.index')}}">Medias</a>
                      </div>
                    </li>
                    @endif

                    @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownParameters" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Paramètres
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownParameters">
                        <a class="dropdown-item" href="{{route('admin.tools.sitelists.index')}}">Listes</a>
                        <a class="dropdown-item" href="{{route('admin.tools.filelist.index')}}">Documents</a>
                        <a class="dropdown-item" href="{{route('admin.tags')}}">Liste des tags</a>
                        <a class="dropdown-item" href="{{route('admin.tools.emailstemplates.index')}}">E-mails type</a>
                        <a class="dropdown-item" href="{{route('admin.content.typologies.index')}}">Typologies</a>
                        <a class="dropdown-item" href="{{route('admin.content.categories.index')}}">Catégories</a>
                      </div>
                    </li>
                    @else
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('admin.tags')}}">
                                Liste tags
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('admin.users.index')}}">
                                Utilisateurs
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('admin.massmail')}}">
                            Envoyer email
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <!--
    <div class="navbar-collapse bg-primary">
        <ul class="nav navbar-nav">

              {{-- <li class="dropdown">
                  <a href="#" >
                        <i class="fa fa-envelope"></i>
                        <span class="badge badge-notify">3</span>
                    </a>
              </li> --}}

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Contenus du site
                    <b class="caret"></b>
                    <div class="ripple-container"></div>
                </a>
                <ul class="dropdown-menu dropdown-menu-right default-padding">
                    <li>
                        <a href="{{route('admin.content.index')}}">
                            News
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Pages
                        </a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Bonjour, {{Auth::user()->firstname}}
                    <b class="caret"></b>
                    <div class="ripple-container"></div>
                </a>
                <ul class="dropdown-menu dropdown-menu-right default-padding">
                    <li class="dropdown-header"></li>
                    <li>
                        @role(['admin','user'])
                            <a href="{{ route('admin.account') }}">
                                <i class="fa fa-user-circle-o"></i>
                                    &nbsp;Mon compte
                            </a>
                        @endrole
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> &nbsp; Déconnexion
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
-->


</header>
