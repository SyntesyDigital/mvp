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
                        <?php echo $__env->make('architect::partials.topbar-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </ul>
                  </nav>
                </div>

                <div class="col-xs-2">

                  <div class="topbar-right">

                    <div class="navbar-collapse">
                      <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <?php echo e(Lang::get('architect::header.hello')); ?> <?php echo e(Auth::user()->lastname); ?>,
                              <b class="caret"></b>
                              <div class="ripple-container"></div>
                            </a>
                              <ul class="dropdown-menu dropdown-menu-right default-padding">
                                  <li class="dropdown-header"></li>

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
