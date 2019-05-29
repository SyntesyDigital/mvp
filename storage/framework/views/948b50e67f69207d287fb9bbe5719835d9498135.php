<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo e(App::getLocale()); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=11" />
        <meta http-equiv="Content-Language" content="<?php echo e(App::getLocale()); ?>"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

        <title><?php echo isset($htmlTitle) ? $htmlTitle : 'BWO Interim'; ?></title>
        <meta name="description" content="<?php echo isset($metaDescription) ? $metaDescription : ''; ?>">
        <meta property="og:url" content="<?php echo e(Request::url()); ?>" />
        <meta property="og:title" content="<?php echo isset($htmlTitle) ? $htmlTitle : ''; ?>"/>
        <meta property="og:description" content="<?php echo isset($socialDescription) ? $socialDescription : ''; ?>"/>
        <meta property="og:image" content="<?php echo isset($socialImage) ? $socialImage : asset('images/header-logo.jpg'); ?>"/>
        <meta property="og:type" content="website"/>
        <meta name="robots" content="noindex,nofollow">

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image"/>
    		<meta name="twitter:site" content=""/>
    		<meta name="twitter:creator" content=""/>
    		<meta name="twitter:title" content=""/>
    		<meta name="twitter:description" content=""/>


        <link href="<?php echo e(asset('modules/bwo/css/app.css')); ?>" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" media="all" href="<?php echo e(asset('modules/bwo/css/font-awesome/css/font-awesome.min.css')); ?>" />-->
        <link rel="stylesheet" media="all" href="<?php echo e(asset('modules/bwo/fonts/iconmoon/iconmoon.css')); ?>" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <?php echo $__env->yieldPushContent('styles'); ?>

    </head>

    <body class="<?php echo e(isset($mainClass) ? $mainClass : ''); ?>">


        <?php echo $__env->make('bwo::partials.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldPushContent('modal'); ?>

        <?php echo $__env->make('bwo::partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <!-- Footer blade important to add JavasCript variables from Controller -->
        <?php echo $__env->make('bwo::partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <script>
          const WEBROOT = '<?php echo e(route("home")); ?>';
          const ASSETS = '<?php echo e(asset('')); ?>';
          const LOCALE = '<?php echo e(App::getLocale()); ?>';
          const app = {};
          var csrf_token = "<?php echo e(csrf_token()); ?>";
          var civility_default = "<?php echo e(Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE); ?>"
          var routes = {
            'login':"<?php echo e(route('candidate.login')); ?>",
            'candidate.store':"<?php echo e(route('candidate.store')); ?>",
            'candidate.addcv' : "<?php echo e(route('candidate.addcv')); ?>",
            'candidate.addtag' : "<?php echo e(route('candidate.addtag')); ?>",
            'candidate.addtag' : "<?php echo e(route('candidate.addtag')); ?>",
            'offer.applications.create' : "<?php echo e(route('offer.applications.create',['offer' => ':offer_id'])); ?>"
          };
        </script>
        <script type="text/javascript" src="<?php echo e(route('localization.js', App::getLocale())); ?>" ></script>

        <!-- Select2 -->

        <script src="<?php echo e(asset('modules/architect/plugins/dropzone/dropzone.min.js')); ?>"></script>
        <?php echo $__env->yieldPushContent('javascripts-libs'); ?>

        <script type="text/javascript" src="<?php echo e(asset('modules/bwo/js/app.js')); ?>" ></script>
        <script src="<?php echo e(asset('modules/bwo/js/jquery.imageUploader.js')); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script>

          $(document).ready(function() {
              $(document).on("click","#btn-user-menu",function() {
                $('#main-menu').removeClass('in');
              });

              $(document).on("click","#btn-main-menu",function() {
                $('#user-menu').removeClass('in');
              });

              app.offerapplications.init(
                "<?php echo e(Auth::check() ? Auth::user()->id : 0); ?>",
                <?php echo e(isset($offer) ? $offer->id : 'null'); ?>,
                "<?php echo e(Auth::check() && (Auth::user()->candidate) ? Auth::user()->candidate->resume_file : ''); ?>"
              );

              $(".application-btn").on('click',function(e){
                  app.offerapplications.open();
              });
              $(".enterprise-btn").on('click',function(e){
                  app.offerapplications.openEnterprise();
              });
          });

        </script>


        <?php echo $__env->yieldPushContent('javascripts'); ?>
    </body>
</html>
