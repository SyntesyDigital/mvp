<div id="<?php echo e($id); ?>" class="dropzone-<?php echo e($size); ?> dropzone-<?php echo e($name); ?>">

	<input type="hidden" id="image" name="<?php echo e($name); ?>" value="<?php echo e(isset($image) ? $image : ''); ?>">
	<input type="hidden" id="uploading" name="uploading" value="0">

	<div class="dropzone-container" <?php if($image != null): ?> style="display:none;" <?php endif; ?>>
		<div id="image-dropzone" class="dropzone image-container">
			<div class="progress-bar"></div>
			<div class="background-image" <?php if($size == 'avatar'): ?> style="background-image:url('<?php echo e(asset('images/default-avatar.png')); ?>')" <?php endif; ?>></div>
			<div class="dz-message"></div>

            <div class="fallback">
                <input name="image" type="file" multiple />
            </div>

            <div class="message">
    			<p><?php echo e(Lang::get('architect::fields.drag_file')); ?><br><span class="link"><i class="fa fa-upload"></i> &nbsp; <?php echo e(Lang::get('architect::fields.upload_file')); ?></span></p>
					<?php if(isset($sizeText)): ?>
						<p>( <?php echo e(Lang::get('architect::fields.size')); ?> <?php echo e($sizeText); ?> )</p>
					<?php endif; ?>
    		</div>
    	</div>
	</div>

	<div class="image-container uploaded" <?php if($image == null): ?> style="display:none;" <?php endif; ?>>
		<div class="background-image" <?php if($image != null): ?> style="background-image:url('<?php echo e(Storage::url($image)); ?>')" <?php endif; ?>>
		</div>
		<div class="actions">
			<a href="" class="btn btn-table" id="remove-picture"><i class="fa fa-trash"></i> &nbsp; <?php echo e(Lang::get('architect::fields.delete')); ?> </a>
		</div>
	</div>

</div>

<?php $__env->startPush('javascripts'); ?>
	<script>
		$(".dropzone-<?php echo e($name); ?>").imageUploader({
			resizeWidth : <?php echo e(isset($resizeWidth) ? $resizeWidth : 'null'); ?>

		});
	</script>
<?php $__env->stopPush(); ?>
