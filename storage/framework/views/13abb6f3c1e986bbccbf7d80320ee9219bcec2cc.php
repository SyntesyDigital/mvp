<?php
	$metaDescription = strip_tags(str_replace('&#39;', '\'', $offer->description));
	$metaDescription = str_replace(array("\r\n", "\r", "\n"), "", $metaDescription);
	$metaDescription = trim(substr(strip_tags($metaDescription), 0, 180));
	$metaDescription = mb_substr($metaDescription, 0, strrpos($metaDescription, ' ')) . " ...";
?>



<?php $__env->startSection('content'); ?>
    <div class="banner banner-small offer-banner" style="background-image:url('<?php echo e(asset('modules/bwo/images/offer-banner.jpg')); ?>')">
    </div>
    <div class="offers-container">
      <div class="horizontal-inner-container offer-container">
          <ol class="breadcrumb">
            <li><a href="<?php echo e(route('home')); ?>">ACCUEIL</a></li>
            <li><a href="<?php echo e(route('search')); ?>">OFFERS</a></li>
            <li><a href="<?php echo e(route('search')); ?>?job[]=<?php echo e($offer->job_1); ?>"><?php echo e(strtoupper(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_1, 'jobs1'))); ?></a></li>
            <li><?php echo e($offer->title); ?></li>
          </ol>
          <h1><?php echo e($offer->title); ?></h1>
          <div class="separator"></div>
          <p class="first-info"><?php echo e($offer->address); ?>, Contrat <?php echo e(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->contract, 'contracts')); ?> - Publié le <?php echo e($offer->start_at); ?> </p>
          <div class="col-sm-4 col-md-3 information">
            <h2 class="gray-square-text">DÉTAILS</h2>
            <div class="block-info">
              <p><b>Lieu:</b></p>
              <p><?php echo e($offer->address); ?></p>
            </div>
            <div class="block-info">
              <p><b>Contrat:</b></p>
              <p><?php echo e(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->contract, 'contracts')); ?></p>
            </div>
            <div class="block-info">
              <p><b>À partir du:</b></p>
              <p><?php echo e(Date('d/m/Y', $offer->start_at )); ?></p>
            </div>
            <div class="block-info">
              <p><b>Secteur:</b></p>
              <p><?php echo e(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_1, 'jobs1')); ?> / <?php echo e(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_2, 'jobs2')); ?></p>
            </div>
						<?php if($offer->salary): ?>
	            <div class="block-info">
	              <p><b>Salaire:</b></p>
	              <p><?php echo e(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->salary, 'salaries')); ?></p>
	            </div>
						<?php endif; ?>
            <div class="reference">REF : <?php echo e($offer->id); ?> | <?php echo e($offer->start_at); ?></div>
            <div class="share-container">
              <?php
      					$shareUrl = urlencode(Request::url());
      					$title = isset( $offer->title ) ?  $offer->title : '';
      					$description = isset( $offer->description ) ?  $offer->description : '';
      				?>

               Partager:
               <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($shareUrl); ?>&t=<?php echo e($title); ?>"
        					class="share-button first-share-btn"
        					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
        					 target="_blank" title="Share on Facebook">
        					<img src="<?php echo e(asset('modules/bwo/images/fb_icon.jpg')); ?>" class="social-icon">
        				</a>

                <a href="https://twitter.com/share?url=<?php echo e($shareUrl); ?>&text=<?php echo e($title); ?>"
        					class="share-button"
        					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
        					 target="_blank" title="Share on Twitter">
        					<img src="<?php echo e(asset('modules/bwo/images/tw_icon.jpg')); ?>" class="social-icon">
        				</a>

                <a href="mailto:?subject=<?php echo e($title); ?>&body=<?php echo e($shareUrl); ?>"
        					class="mail-button">
        					<img src="<?php echo e(asset('modules/bwo/images/mail_icon.jpg')); ?>" class="social-icon">
        				</a>

            </div>
          </div>
          <div class="col-sm-8 col-md-9 description">
            <?php echo $offer->description; ?>

            <p class="title">PROFIL RECHERCHÉ</p>
						<?php echo $offer->perfil; ?>

            <p><b>Diplôme: </b> bac + 2</p>
            <p><b>Expérience requise: </b> Expérience similaire de 5 ans</p>
            <p><b>Langue: </b>anglis opérationnel</p>
            <p><b>Logiciel: </b>PACK OFFICE</p>
						<p><b>Horaries: </b>
							<?php
								$values = Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->schedule, 'schedule');
							?>

							<?php if(is_array($values)): ?>
								<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php echo e($v); ?> ,
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<?php echo e($values); ?>

							<?php endif; ?>
						</p>

          </div>
          <br clear="all">
          <div class="btn-red-container">

            <?php if(Auth::check() && !Auth::user()->hasRole(['admin', 'recruiter'])): ?>
                <?php if($offer->hasAlreadyCandidate()): ?>
                  <a id="<?php echo e($offer->id); ?>"  class="btn btn-red unactivated">
                    <i class="fa fa-check"></i> Déjà postulé
                  </a>
                <?php else: ?>
                  <a id="<?php echo e($offer->id); ?>"  class="btn btn-red application-btn">
                    <i class="fa fa-file-text-o"></i> POSTULER
                  </a>
                <?php endif; ?>
            <?php else: ?>
                <a id="<?php echo e($offer->id); ?>"  class="btn btn-red application-btn">
                  <i class="fa fa-file-text-o"></i> POSTULER
                </a>
            <?php endif; ?>
          </div>
      </div>
    </div>
    <div class="offers-3-container">
        <?php echo $__env->make('bwo::partials.three-offers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts'); ?>
	<script>

    $(document).ready(function() {

    });

  </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('bwo::layouts.master', [
	'socialTitle' => $offer->title,
	'htmlTitle' => $offer->title,
	'pageTitle' => $offer->title,
	'headerDescription' => $offer->address,
	'metaDescription' => $metaDescription,
	'socialDescription' => $metaDescription,
	'headerDate' => $offer->start_at
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>