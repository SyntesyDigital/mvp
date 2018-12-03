<?php $__env->startSection('content'); ?>
<div class="body">
    <div class="row">
		<?php echo Form::open([
				'url' => route('account.save'),
				'files'=>true,
				'method' => 'POST'
			]); ?>

		<?php echo e(csrf_field()); ?>

		<div class="col-md-offset-1 col-md-3">
			<div class="card">
				<div class="card-body">

					<?php echo $__env->make('architect::components.dropzone-image',[
						'image' => isset($user) && isset($user->image) ? $user->image : null,
						'size' => 'avatar',
						'id' => 'dropzone-1',
						'name' => 'image',
						'resizeWidth' => 500
					], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<h4 class="info-title text-center"><?php echo e(isset($user->full_name) ? $user->full_name : ''); ?></h4>
				</div>
			</div>
		</div>

        <div class="col-md-7">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title"><?php echo e(Lang::get('architect::user.my_account')); ?></h3>
    				
		            <div class="row">
		                <div class="col-md-6">
		                    <div class="form-group label-floating">
		                        <label class="control-label"><?php echo e(Lang::get('architect::fields.firstname')); ?></label>
		                        <input type="text" name="firstname" value="<?php echo e(isset($user->firstname) ? $user->firstname : ''); ?>" class="form-control">
		                    </div>
		                </div>

		                <div class="col-md-6">
		                    <div class="form-group label-floating">
		                        <label class="control-label"><?php echo e(Lang::get('architect::fields.lastname')); ?></label>
		                        <input type="text" name="lastname" value="<?php echo e(isset($user->lastname) ? $user->lastname : ''); ?>" class="form-control"/>
		                    </div>
		                </div>
		            </div>

					<div class="form-group label-floating">
		                <label class="control-label"><?php echo e(Lang::get('architect::fields.email')); ?></label>
		                <input type="text" name="email" value="<?php echo e(isset($user->email) ? $user->email : ''); ?>" class="form-control"/>
		            </div>

		            <div class="form-group label-floating">
		                <label class="control-label"><?php echo e(Lang::get('architect::fields.password')); ?></label>
		                <input type="password" name="password" value="" class="form-control"/>
		            </div>

		            <div class="form-group label-floating">
		                <label class="control-label"><?php echo e(Lang::get('architect::fields.co_password')); ?></label>
		                <input type="password" name="confirm_password" value="" class="form-control"/>
		            </div>

		            <div class="form-group label-floating text-left">
						<input type="submit" value=<?php echo e(Lang::get('architect::fields.send')); ?> class="btn btn-success submit-form"/>
		            </div>
				</div>
			</div>
        </div>
		<?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugins'); ?>
	<?php echo Html::style('/modules/architect/plugins/dropzone/dropzone.min.css'); ?>

    <?php echo Html::script('/modules/architect/plugins/dropzone/dropzone.min.js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>

	<?php echo Html::script('/modules/architect/js/libs/jquery.imageUploader.js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>