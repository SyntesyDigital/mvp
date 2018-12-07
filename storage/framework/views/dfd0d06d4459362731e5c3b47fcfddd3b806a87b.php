<?php if(!isset($div)): ?>
<div id="<?php echo e(isset($field['settings']['htmlId']) ? $field['settings']['htmlId'] : ''); ?>" class="<?php echo e(isset($field['settings']['htmlClass']) ? $field['settings']['htmlClass'] : ''); ?>">
<?php endif; ?>
  <?php echo e(isset($field['value'][App::getLocale()]) ? $field['value'][App::getLocale()] : ''); ?>

<?php if(!isset($div)): ?>
</div>
<?php endif; ?>
