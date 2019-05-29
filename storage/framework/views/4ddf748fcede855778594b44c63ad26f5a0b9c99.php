<?php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($contentSettings) && isset($contentSettings['pageType']) ? $contentSettings['pageType'] : '';
  $idClass = isset($content) ? "id_".$content->id : '';
?>



<?php $__env->startSection('content'); ?>

<?php if(isset($content) && $content->parent_id != null): ?>
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

      		  <div class="col-md-2 col-sm-3 col-xs-6">
      		  	<div id="selected-items" class="seleccio" style="display:none;">
                <span id="number">0</span>
                <a href="#" id="selected-area">La meva sel.lecció</a>
              </div>
      		  </div>
    	   </div>
  		 </div>
  	</div>
  </div>
</div>
<?php endif; ?>



<!-- ARTICLE -->
<article class="page-builder">

    <?php if($page): ?>
      <?php $__currentLoopData = $page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $__env->make('turisme::partials.node', [
              'node' => $node
          ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
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
  'mainClass' => $pageType.' '.$htmlClass.' '.$idClass,
  'routeAttributes' => $content->getFullSlug()
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>