<?php $__env->startSection('content'); ?>

<?php echo Form::open([
		'url' => route('rrhh.admin.massmail.send'),
		'method' => 'POST',
    	'class' => 'toggle-sendmassmail'
	]); ?>

<?php echo e(csrf_field()); ?>



<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> <?php echo e(Lang::get('rrhh::settings.massmail')); ?>

                </h1>

                <div class="float-buttons pull-right">
                    <?php echo Form::submit(Lang::get('architect::fields.save'), [
                            'class' => 'btn btn-primary submit-form'
                        ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="container rightbar-page">

	
	<div class="col-md-9 page-content">
		<div class="form-group label-floating <?php echo e($errors->has("subject") ? 'has-error' : ''); ?>">
			<?php echo Form::label('Sujet'); ?>

			<?php echo Form::text('subject', old('subject'), [
					'class' => 'form-control'
				]); ?>

	    </div>

	    <div class="form-group label-floating <?php echo e($errors->has("reply_to") ? 'has-error' : ''); ?>">
			<?php echo Form::label('Répondre à'); ?>

			<?php echo Form::text('reply_to', old('reply_to', env('MAIL_NO_REPLY')), [
					'class' => 'form-control'
				]); ?>

	    </div>

	    <div class="form-group label-floating <?php echo e($errors->has("message") ? 'has-error' : ''); ?>">
			<?php echo Form::label('Message'); ?>

			<?php echo Form::textarea('message', old('message'), [
					'class' => 'form-control',
					'rows' => 15
				]); ?>

	    </div>
	</div>

	
	<div class="sidebar">
		<h3>Candidats destinataires du message</h3>

		<?php $__currentLoopData = [
			Modules\RRHH\Entities\Offers\Candidate::TYPE_NORMAL,
			Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM
		]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo Form::checkbox('recipients[]', $name, old('recipients[' . $name . ']') ? true : false); ?>


		<?php echo e($name); ?> (<?php echo e(Modules\RRHH\Entities\Offers\Candidate::countByType($name)); ?>)

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



		
	</div>

</div>

<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascripts'); ?>
<script>
    $('form.toggle-sendmassmail').on('submit', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: 'Etes-vous sur de vouloir envoyer cet message ?',
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Non',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result) {
                    $('form.toggle-sendmassmail')
                        .off('submit')
                        .trigger('submit');
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>