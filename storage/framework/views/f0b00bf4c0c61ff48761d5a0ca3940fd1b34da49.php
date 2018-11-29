<header>
    <div class="topnav">

        
        <div class="topnav-top">
            <div class="container">
              <div class="row">

                <div id="logo-wrapper" class="col-xs-2">
                    <img src="<?php echo e(asset('modules/architect/images/client-logo.jpg')); ?>" alt="Logo" />
                </div>

                <div class="col-xs-8">
                  <nav class="main-nav">
                    <ul>

                      <li class="<?php echo e(Request::is('architect') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('dashboard')); ?>">
                        <?php echo e(Lang::get('architect::header.home')); ?>

                        </a>
                      </li>

                      <li class="<?php echo e(Request::is('architect') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>">
                        <?php echo e(Lang::get('architect::header.offers')); ?>

                        </a>
                      </li>

                        <?php if(Auth::user()->hasRole(["admin"])): ?>
                      <li class="<?php echo e(Request::is('architect/typologies*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('typologies')); ?>">
                          <?php echo e(Lang::get('architect::header.typology')); ?>

                        </a>
                      </li>
                        <?php endif; ?>
                      <li class="<?php echo e(Request::is('architect/contents*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('contents')); ?>">
                        <?php echo e(Lang::get('architect::header.contents')); ?>

                        </a>
                      </li>

                      <li class="<?php echo e(Request::is('architect/medias*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('medias.index')); ?>">
                          <?php echo e(Lang::get('architect::header.media')); ?>

                        </a>
                      </li>

                       <?php if(Auth::user()->hasRole(["admin"])): ?>
                      <li class="<?php echo e(Request::is('architect/settings*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('settings')); ?>">
                          <?php echo e(Lang::get('architect::header.configuration')); ?>

                        </a>
                      </li>
                      <?php endif; ?>
                    </ul>
                  </nav>
                </div>

                <div class="col-xs-2">

                  <div class="topbar-right">

                    <div class="navbar-collapse">
                      <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <?php echo e(Lang::get('architect::header.hello')); ?> <?php echo e(Auth::user()->firstname); ?>,
                              <b class="caret"></b>
                              <div class="ripple-container"></div>
                            </a>
                              <ul class="dropdown-menu dropdown-menu-right default-padding">
                                  <li class="dropdown-header"></li>
                                  <li>
                                      <a href="<?php echo e(route('users.show',Auth::user()->id)); ?>">
                                          <i class="fa fa-user"></i>
                                          &nbsp;<?php echo e(Lang::get('architect::header.my_profile')); ?>

                                      </a>
                                  </li>
                                  <li>
                                      <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                          <i class="fa fa-sign-out"></i> &nbsp; <?php echo e(Lang::get('architect::header.disconnect')); ?>

                                      </a>
                                      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                      <?php echo e(csrf_field()); ?>

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
                        <a class="nav-link" href="<?php echo e(route('medias.index')); ?>">
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
