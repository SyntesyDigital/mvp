<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo e(App::getLocale()); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=11" />
        <meta http-equiv="Content-Language" content="<?php echo e(App::getLocale()); ?>"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <title><?php echo e(isset($title) ? $title : Lang::get("front::messages.seo.title")); ?></title>
        <meta name="keywords" lang="<?php echo e(App::getLocale()); ?>" content="" />
        <meta name="description" lang="<?php echo e(App::getLocale()); ?>" content="" />
        <meta name="abstract" content="" />
  	    <meta name="author" content="" />
        <meta name="robots" content="noindex,nofollow">

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image"/>
    		<meta name="twitter:site" content=""/>
    		<meta name="twitter:creator" content=""/>
    		<meta name="twitter:title" content=""/>
    		<meta name="twitter:description" content=""/>

        <!-- facebook -->
    		<meta property="og:url" content="" />
    		<meta property="og:image" content="" />
    		<meta property="og:title" content=""/>
    		<meta property="og:description" content=""/>
    		<meta property="og:type" content="website"/>

        <link href="<?php echo e(asset('modules/front/css/app.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">


        <?php echo $__env->yieldPushContent('styles'); ?>


    </head>
    <body class="<?php echo e(isset($mainClass) ? $mainClass : ''); ?>">

        <?php echo $__env->yieldPushContent('modal'); ?>

        <?php echo $__env->make('front::partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div>


          <?php echo $__env->make('front::partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>
        <!-- Footer blade important to add JavasCript variables from Controller -->
        <?php echo $__env->make('front::partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <script>
          const WEBROOT = '<?php echo e(route("home")); ?>';
          const ASSETS = '<?php echo e(asset('')); ?>';
          const LOCALE = '<?php echo e(App::getLocale()); ?>';
        </script>
        
        <script type="text/javascript" src="<?php echo e(route('localization.js', App::getLocale())); ?>" ></script>

        <?php echo $__env->yieldPushContent('javascripts-libs'); ?>

        <!-- Language -->
        <script type="text/javascript" src="<?php echo e(asset('modules/front/js/lang.dist.js')); ?>" ></script>
        <script>
            Lang.setLocale('<?php echo e(App::getLocale()); ?>');
        </script>

        <script type="text/javascript" src="<?php echo e(asset('modules/front/js/app.js')); ?>" ></script>
        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


        <?php echo $__env->yieldPushContent('javascripts'); ?>
    </body>
</html>
