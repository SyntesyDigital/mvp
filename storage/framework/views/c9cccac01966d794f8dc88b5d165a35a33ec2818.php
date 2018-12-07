<?php
  $htmlClass = 'blog '.(isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '');
  $pageType = isset($content->typology->name) ? $content->typology->name : '';
  $idClass = isset($content) ? "id_".$content->id : '';
?>



<?php $__env->startSection('content'); ?>

<?php if(isset($content)): ?>
<div class="single">
  <div class="breadcrumb">
       <div class="container">
        <div class="row">
          <div class="detalls-single">
      		  <div class="col-md-10  col-sm-9 col-xs-12">
      		  	<div class="ariadna">
                <?php echo breadcrumb($content); ?>

                </div>
      		  </div>
    	   </div>
  		 </div>
  	</div>
  </div>
</div>
<?php endif; ?>

<!-- ARTICLE -->
<article class="content">
   <!-- Col 12 -->
  <div class="grey-intro no-margin">
       <div class="container">
        <div class="row">
        <div class="claim">

        <h1><?php echo e($content->getFieldValue('title')); ?></h1>
        <p>
            <?php echo $content->getFieldValue('descripcio'); ?>

        </p>
        </div>
      </div>
    </div>

  </div>

  <!-- POt ser vairies coses -->

   <div class="white">
      <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-10 col-xs-12 centered">
            <?php $any_media = false;   ?>
            <?php if($fields['rotatorio']['value'] && count($fields['rotatorio']['value']) > 0): ?>
              <?php echo $__env->make('turisme::partials.fields.carousel_single',  [
               "field" => $fields['rotatorio'],
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php $any_media = true; ?>
            <?php endif; ?>

            <?php if(isset($fields['video']['value']['url'][App::getLocale()])): ?>
              <?php echo $__env->make('turisme::partials.fields.video',  [
                 "field" => $fields['video'],
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php $any_media = true; ?>
            <?php endif; ?>

            <?php if(!$any_media && $fields['imatge']['value']): ?>
              <img
                src="<?php echo e(isset($fields['imatge']['value']['urls']['large']) ? asset($fields['imatge']['value']['urls']['large']) : null); ?>"
                alt="<?php echo e(isset($fields['imatge']['value']->metadata['fields']['alt'][App::getLocale()]['value']) ? $fields['imatge']['value']->metadata['fields']['alt'][App::getLocale()]['value'] : ''); ?>"
                title="<?php echo e(isset($fields['imatge']['value']->metadata['fields']['title'][App::getLocale()]['value']) ? $fields['imatge']['value']->metadata['fields']['title'][App::getLocale()]['value'] : ''); ?>"
              />
            <?php endif; ?>

            </div>
        </div>
      </div>
    </div>
  </div>

    <div class="white">
      <div class="row">
        <div class="container">
          <div class="col-md-9 col-sm-10 col-xs-12 centered">
            <?php  $categories = $content->categories->all(); $first_cat = true; ?>
            <p class="details">
              <?php echo e(null !== $content->getFieldValue('data')? date('d-m-Y',$content->getFieldValue('data')):""); ?>

              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($first_cat): ?>
                  |
                  <?php $first_cat = false; ?>
                <?php else: ?>
                   ·
                <?php endif; ?>
                <a href="<?php echo e(route('blog.category.index' , $cat->getFieldValue('slug'))); ?>"><?php echo e($cat->getFieldValue('name')); ?></a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               | <span><?php echo e($content->author->firstname.' '.$content->author->lastname); ?></span>
              </p>
              <?php if($content->getFieldValue('es-entrevista')): ?>
                <p><?php echo e($content->getFieldValue('nom')); ?></p>
                <p><?php echo e($content->getFieldValue('carrec')); ?></p>
              <?php endif; ?>
              <?php echo $content->getFieldValue('contingut'); ?>


          <ul class="tags_blog">
            <?php  $tags = $content->tags->all(); ?>
              <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li  href="<?php echo e($tag->getFieldValue('slug')); ?>"><a href="<?php echo e(route('blog.tag.index' ,$tag->getFieldValue('slug'))); ?>" ><?php echo e($tag->getFieldValue('name')); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>

        </div>
      </div>
    </div>

    <div id="related-news" content="<?php echo e($content->id); ?>" tags="<?php echo e(isset($content->tags)?$content->tags->pluck('id'):null); ?>" category="<?php echo e(null !== $content->categories->first()?$content->categories()->first()->id:null); ?>" ></div>


    <div id="blog" init="0" showTags="0" ></div>

  </div>



</div>
</article>
<!-- END ARTICLE -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts'); ?>
<script>
    routes = {"categoryNews" : "<?php echo e(route('blog.category.index' ,['slug' => ':slug'])); ?>",
              "tagNews"      : "<?php echo e(route('blog.tag.index' ,['slug' => ':slug'])); ?>" };
    $(function(){

    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('turisme::layouts.app',[
  'title' => isset($content) ? $content->getFieldValue('title') : '',
  'mainClass' => $pageType.' blog '.$htmlClass.' '.$idClass
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>