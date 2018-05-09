<header>
    <div class="topnav">

        {{-- TOP NAV BAR --}}
        <div class="topnav-top">
            <div class="container">
                <div class="topbar-left">
                    TurismoBCN
                </div>

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
                                    <a href="#">
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

        {{-- BOTTOM NAV BAR --}}
        <div class="topnav-bottom">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">
                          Inicio
                      </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="clearfix"></div>
</header>
