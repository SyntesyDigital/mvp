<?php if(isset($related_offers)): ?>
<div class="three-offers-container">
  <div class="horizontal-inner-container">
    <h2>CES OFFRES POURRAIENT VOUS INTÉRESSER</h2>

    <?php $__currentLoopData = $related_offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <div class="col-md-4 ">
        <div class="offer-box">
            <div class="title">
              <?php echo e($related_offer->title); ?>

            </div>
            <p>Réf: <?php echo e($related_offer->id); ?> - Posté le <?php echo e($related_offer->start_at); ?></p>
            <?php
              $string = substr(strip_tags($related_offer->description), 0, 100);
              if(strlen($string) < strlen(strip_tags($related_offer->description))){
                $string = substr($string, 0, strrpos($string, ' ')) . " ...";
              }
            ?>
            <div class="description">
            <p><?php echo $string; ?></p>
            </div>
            <?php
             $otags = $related_offer->tags()->get();
            ?>
            <div class="buttons">
              <?php $__currentLoopData = $otags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#" class="btn btn-soft-gray tag"><?php echo e($otag->name); ?></a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <a href="<?php echo e(route('offer.show', [
                                  'job_1' => str_slug(Modules\RRHH\Entities\Tools\SiteList::getListValue($related_offer->job_1, 'jobs1'), '-'),
                                  'id' => $related_offer->id
                              ])); ?>" class="detail" >DÉTAIL DE L'OFFRE</a>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <br clear="all">
  </div>
</div>
<?php endif; ?>
