<div class="item <?php echo e($class); ?> <?php echo e(isset($settings['htmlClass']) ? $settings['htmlClass'] : ''); ?>">

  <?php
    $urlField = $field['fields'][3];
    $link = "";
    $target = "";
    if(isset($urlField['value']['content'])){
      //is internal
      $content = $urlField['value']['content'];
      $link = $content->url;
    }
    else {
      //is external
      $target = "_blank";
      $link = isset($urlField['value']['url'][App::getLocale()]) ? $urlField['value']['url'][App::getLocale()] : '';
    }
  ?>

  <?php echo $__env->make('turisme::partials.fields.'.$field['fields'][0]['type'],
    [
      "field" => $field['fields'][0],
      "settings" => $settings,
      "div" => false,
      "class" => 'center-block'
    ]
  , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php if(isset($field['fields'][1]['value'][App::getLocale()]) && $field['fields'][1]['value'][App::getLocale()] != ''): ?>
  <div class="carousel-caption">
    <?php if($link != ""): ?>
      <a href="<?php echo e($link); ?>" target="<?php echo e(isset($target) ? $target : ''); ?>">
    <?php endif; ?>
      <h3>
        <?php echo $__env->make('turisme::partials.fields.'.$field['fields'][1]['type'],
          [
            "field" => $field['fields'][1],
            "settings" => $settings,
            "div" => false
          ]
        , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </h3>
    <?php if($link != ""): ?>
      </a>
    <?php endif; ?>
    <p>
      <?php echo $__env->make('turisme::partials.fields.'.$field['fields'][2]['type'],
        [
          "field" => $field['fields'][2],
          "settings" => $settings,
          "div" => false
        ]
      , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </p>
  </div>
<?php endif; ?>
</div>
