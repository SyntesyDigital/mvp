<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=11" />
        <meta http-equiv="Content-Language" content="en"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <title>HOME</title>
        <meta name="keywords" lang="rn" content="" />
        <meta name="description" lang="en" content="" />
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

        <link href="<?php echo e(asset('modules/bwo/css/app.css')); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" media="all" href="<?php echo e(asset('modules/bwo/css/font-awesome/css/font-awesome.min.css')); ?>" />


        <?php echo $__env->yieldPushContent('styles'); ?>

    </head>

    <body class="<?php echo e(isset($mainClass) ? $mainClass : ''); ?>">

        <?php echo $__env->yieldPushContent('modal'); ?>

        <?php echo $__env->make('bwo::partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <!-- Footer blade important to add JavasCript variables from Controller -->
        <?php echo $__env->make('bwo::partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <script>
          const WEBROOT = '<?php echo e(route("home")); ?>';
          const ASSETS = '<?php echo e(asset('')); ?>';
          const LOCALE = '<?php echo e(App::getLocale()); ?>';
        </script>

        <?php echo $__env->yieldPushContent('javascripts-libs'); ?>


        <script type="text/javascript" src="<?php echo e(asset('modules/bwo/js/app.js')); ?>" ></script>
        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

        <?php echo $__env->yieldPushContent('javascripts'); ?>
    </body>
</html>
