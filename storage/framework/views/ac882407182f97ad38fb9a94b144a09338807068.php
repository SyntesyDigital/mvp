<div id="<?php echo e(isset($field['settings']['htmlId']) ? $field['settings']['htmlId'] : ''); ?>" class="widget-blog <?php echo e(isset($field['settings']['htmlClass']) ? $field['settings']['htmlClass'] : ''); ?>">


  <div id="blog" class="blog"
    field="<?php echo e(isset($field) ? base64_encode(json_encode($field)) : null); ?>"
    entrevistas="0"
    <?php echo e(isset($_REQUEST['category'])?'categoryId='.$_REQUEST['category']:''); ?>

    <?php echo e(isset($_REQUEST['text'])?'text='.$_REQUEST['text'] :''); ?>

    <?php echo e(isset($_REQUEST['startDate'])?'startDate='.$_REQUEST['startDate']:''); ?>

    <?php echo e(isset($_REQUEST['endDate'])?'endDate='.$_REQUEST['endDate']:''); ?>

  >
  </div>

</div>
