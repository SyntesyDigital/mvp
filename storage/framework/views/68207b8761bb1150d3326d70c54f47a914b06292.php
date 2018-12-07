<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(env('APP_NAME')); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">

        <!-- Global style -->
        <link rel="stylesheet" media="all" href="<?php echo e(asset('modules/architect/css/app.css')); ?>" />
        <link rel="stylesheet" media="all" href="<?php echo e(asset('modules/rrhh/css/app.css')); ?>" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">

        <?php echo $__env->make('architect::layouts.jsconst', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Jquery -->
        <script src="<?php echo e(asset('modules/architect/plugins/jquery/jquery-3.2.1.min.js')); ?>"></script>

        <!-- Toaster -->
        <script src="<?php echo e(asset('modules/architect/plugins/toastr/toastr.min.js')); ?>"></script>
        <link href="<?php echo e(asset('modules/architect/plugins/toastr/toastr.min.css')); ?>" rel="stylesheet" media="all"  />
        <?php echo e(Html::script('/modules/architect/plugins/bootbox/bootbox.min.js')); ?>




        <!-- Language -->
        <?php echo e(Html::script('/modules/architect/js/lang.dist.js')); ?>

        <script>
            Lang.setLocale('<?php echo e(App::getLocale()); ?>');
        </script>

        <!-- code to fix jquery slowing down the browser -->
        <script>
          $(function(){
            jQuery.event.special.touchstart = {
              setup: function( _, ns, handle ){
                if ( ns.includes("noPreventDefault") ) {
                  this.addEventListener("touchstart", handle, { passive: false });
                } else {
                  this.addEventListener("touchstart", handle, { passive: true });
                }
              }
            };
          });
        </script>

        <!-- App -->
        <script src="<?php echo e(asset('modules/architect/js/app.js')); ?>" defer></script>

        <?php echo $__env->yieldPushContent('stylesheets'); ?>

        <?php echo $__env->yieldPushContent('plugins'); ?>
    </head>

    <body>
        <div id="app">
    	       <?php echo $__env->yieldContent('modal'); ?>
		      <section id="wrapper">

	        <section id="main">

                <?php if(Auth::user()): ?>
                    <?php if(!isset($hideTopbar) || (isset($hideTopbar) && $hideTopbar === false)): ?>
    	        	      <?php echo $__env->make('architect::layouts.topbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>

	        	<section id="content">

                    <?php if(isset($errors)): ?>
                        <?php if(count($errors) > 0): ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                            		        <ul>
                            		            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            		                <li><?php echo e($error); ?></li>
                            		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            		        </ul>
                            		    </div>
                                    </div>
                                </div>
                            </div>
                		<?php endif; ?>
                    <?php endif; ?>

                    <?php if(Session::has('notify_error')): ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <?php echo e(Session::get('notify_error')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(Session::has('notify_success')): ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <?php echo e(Session::get('notify_success')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

	        		<?php echo $__env->yieldContent('content'); ?>
	        	</section>
	        </section>
        </section>
        </div>

        <?php echo $__env->yieldPushContent('javascripts-libs'); ?>
        <?php echo $__env->yieldPushContent('javascripts'); ?>
    </body>
</html>
