<header>
    <div class="topnav">

        {{-- TOP NAV BAR --}}
        <div class="topnav-top">
            <div class="container">
              <div class="row">

                <div id="logo-wrapper" class="col-md-2">
                    TurismoBCN
                </div>

                <div class="col-md-8">
                  <nav class="main-nav">
                    <ul>
                      <li>
                        <a href="{{route('typologies')}}">
                          Tipologies
                        </a>
                      </li>
                      <li>
                        <a href="">
                        Content
                        </a>
                      </li>
                      <li>
                        <a href="{{route('medias.index')}}">
                          Medias
                        </a>
                      </li>
                      <li>
                        <a href="">
                          Settings
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>

                <div class="col-md-2">

                  <div class="topbar-right">
                    <div class="navbar-collapse">
                      <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              Hola,
                              <b class="caret"></b>
                              <div class="ripple-container"></div>
                            </a>
                              <ul class="dropdown-menu dropdown-menu-right default-padding">
                                  <li class="dropdown-header"></li>
                                  <li>
                                      <a href="{{route('account')}}">
                                          <i class="fa fa-user-circle-o"></i>
                                          &nbsp;Mi cuenta
                                      </a>
                                  </li>
                                  <li>
                                      <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                          <i class="fa fa-sign-out"></i> &nbsp; Desconectar
                                      </a>
                                      <form id="logout-form" action="#" method="POST" style="display: none;">
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
            </div>
        </div>

        {{-- BOTTOM NAV BAR --}}
        <!--
        <div class="topnav-bottom">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('medias.index')}}">
                            Medias
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        -->

    </div>
    <div class="clearfix"></div>
</header>
