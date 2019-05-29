<?php $__env->startSection('content'); ?>
    <div class="banner banner-small offer-banner" style="background-image:url('<?php echo e(asset('modules/bwo/images/offer-banner.jpg')); ?>')">
      <div class="horizontal-inner-container">
          <h1>VOTRE RECHERCHE</h1>
        </div>
      </div>
    </div>
    <div class="offers-container">
      <div class="horizontal-inner-container">
        <form method="get" action="<?php echo e(route('offers')); ?>">
          <div class="lightest-gray-search-container">
            <ol class="breadcrumb">
              <li><a href="<?php echo e(route('home')); ?>">ACCUEIL</a></li>
              <li>OFFRES</li>
            </ol>

            <div class="btn btn-red btn-search" id="btn-search">
              <i class="fa fa-search"></i>RECHERCHER
            </div>
            <div class="input-search-container">
              <input class="form-control input-round search-input" type="text" placeholder="Métier, ville, contrat..." name="search" value="">
            </div>
            <div class="checkboxes">
              <label>
                 <?php echo e(Form::checkbox('job', '1')); ?>[Métier]
              </label>
              <label>
                  <?php echo e(Form::checkbox('city', '1')); ?>[Ville]
              </label>
              <label>
                <?php echo e(Form::checkbox('contract', '1')); ?>[Contrat]
              </label>
            </div>
            <div class="filter-btn">
              <div class="btn btn-dark-gray" id="btn-more">VOIR PLUS DE FILTRES</div>
              <div class="btn btn-dark-gray" id="btn-less">VOIR MOINS DE FILTRES</div>
            </div>
          </div>
          <div class="light-gray-search-container">
            <div class="col-sm-4 select-container">
              <?php echo Form::Label('job', 'Choisissez votre métier:'); ?>

              <?php echo Form::select('job', [0 => '', 1 =>'Metier 1', 2 => 'Metier 2'], null, ['class' => 'form-control']); ?>

            </div>
            <div class="col-sm-4 select-container">
              <?php echo Form::Label('contract', 'Choisissez votre type de contrat:'); ?>

              <?php echo Form::select('contract', [0 => '', 1 =>'Contrat 1', 2 => 'Contrat 2'], null, ['class' => 'form-control']); ?>

            </div>
            <div class="col-sm-4 select-container">
              <?php echo Form::Label('filter', 'Filtre par:'); ?>

              <?php echo Form::select('filter', [0 => '', 1 =>'Filtre 1', 2 => 'Filtre 2'], null, ['class' => 'form-control']); ?>

            </div>
            <div class="btn btn-dark-gray" id="btn-filtres">APPLIQUER LES FILTRES</div>
          </div>

        </form>
        <div class="offers-list">
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  Assistant comptable H/F
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
                </div>
                <a href="<?php echo e(route('offer')); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
          <br clear="all">
          <div class="pagination-container">
            <!--a href="#" class="round"><div class="round"><i class="fa fa-angle-left" aria-hidden="true"></i></div></a-->
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">...</a>
            <a href="#" class="round"><div class="round"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a>
          </div>

        </div>
      </div>
    </div>

<?php $__env->stopSection(); ?>

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