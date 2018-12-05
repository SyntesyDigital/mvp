<?php
  $crop = "large";

  $settings = isset($settings) ? $settings : $field['settings'];
  $settings = json_decode(json_encode($settings), true);

  if(isset($settings) && isset($settings['cropsAllowed']) && $settings['cropsAllowed'] != null){
    $crop = $settings['cropsAllowed'];
  }
  $url = isset($field['value']) && isset($field['value']->getUrlsAttribute()[$crop]) ? asset($field['value']->getUrlsAttribute()[$crop]) : null;
?>
<?php if(!isset($div)): ?>
<p class="<?php echo e(isset($settings['htmlClass']) ? $settings['htmlClass'] : ''); ?>">
<?php endif; ?>

<?php if(isset($url)): ?>
  <img
    id="<?php echo e(isset($settings['htmlId']) ? $settings['htmlId'] : ''); ?>"
    class="<?php echo e(isset($settings['htmlClass']) ? $settings['htmlClass'] : ''); ?>"
    src="<?php echo e(isset($field['value']->getUrlsAttribute()[$crop]) ? asset($field['value']->getUrlsAttribute()[$crop]) : null); ?>"
    alt="<?php echo e(isset($field['value']->metadata['fields']['alt'][App::getLocale()]['value']) ? $field['value']->metadata['fields']['alt'][App::getLocale()]['value'] : ''); ?>"
    title="<?php echo e(isset($field['value']->metadata['fields']['title'][App::getLocale()]['value']) ? $field['value']->metadata['fields']['title'][App::getLocale()]['value'] : ''); ?>"
    width="<?php echo e(isset($width) ? $width : ''); ?>"
    height="<?php echo e(isset($height) ? $height : ''); ?>"
  />
<?php endif; ?>

<?php if(!isset($div)): ?>
</p>
<?php endif; ?>
