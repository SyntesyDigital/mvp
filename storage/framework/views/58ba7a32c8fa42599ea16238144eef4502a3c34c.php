<?php $__env->startSection('content'); ?>
    <div class="banner banner-small offer-banner" style="background-image:url('<?php echo e(asset('modules/bwo/images/offer-banner.jpg')); ?>')">
      <div class="horizontal-inner-container">
          <h1>BONJOUR [PRÉNOM]</h1>
        </div>
      </div>
    </div>
    <div class="candidate-container">
      <div class="horizontal-inner-container">

        <div class="candidate-list">
          <ol class="breadcrumb">
            <li><a href="<?php echo e(route('home')); ?>">ACCUEIL</a></li>
            <li>ESPACE CANDIDAT</li>
          </ol>
          <div class="col-md-8 information-container">
            <div class="col-md-4">
              <div class="image" style="background-image:url('<?php echo e(asset('modules/bwo/images/no_picture.jpg')); ?>')"></div>
            </div>
            <div class="col-md-8">
              <div class="information">
                <p class="name">Prénom, Nom</p>
                <p>Adresse, 2ème ligne addresse</p>
                <p>e-mail</p>
                <div class="btn btn-soft-gray">CHANGER LA PHOTO DE PROFIL</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="candidate-box">
              <i class="fa fa-bell"></i>
              <div class="btn-container">
                <a href="" class="btn btn-dark-gray">GÉRER VOS ALERTS</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="candidate-box">
              <i class="far fa-address-card"></i>
              <div class="btn-container">
                <a href="<?php echo e(route('candidate.form')); ?>" class="btn btn-dark-gray">GÉRER VOS INFORMATIONS</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="candidate-box">
              <i class="fas fa-clipboard-list"></i>
              <div class="btn-container">
                <a href="" class="btn btn-dark-gray">VOS CANDIDATURES</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="candidate-box">
              <i class="fa fa-briefcase"></i>
              <div class="btn-container">
                <a href="" class="btn btn-dark-gray">VOS DOCUMENTS</a>
              </div>
            </div>
          </div>
          <br clear="all">

        </div>
      </div>
    </div>
    <div class="three-colors-separator">
      <div class="separator-piece dark-gray"></div>
      <div class="separator-piece soft-gray"></div>
      <div class="separator-piece red"></div>
    </div>
    <div class="offers-3-container candidate-page">
        <?php echo $__env->make('bwo::partials.three-offers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
<?php $__env->stopPush(); ?>


<?php $__env->startPush('javascripts'); ?>
	<script>

    $(document).ready(function() {
        $(document).on("click","#btn-more",function() {
          $(this).hide();
          $('#btn-less').show();
          $('.light-gray-search-container').show();
        });

        $(document).on("click","#btn-less",function() {
          $(this).hide();
          $('#btn-more').show();
          $('.light-gray-search-container').hide();
        });
        $(document).ready(function() {
            $(document).on("click",".btn-search",function() {
              $(this).closest('form').submit();
            });
        });
        $(document).ready(function() {
            $(document).on("click","#btn-filtres",function() {
              $(this).closest('form').submit();
            });
        });


    });

  </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('bwo::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>