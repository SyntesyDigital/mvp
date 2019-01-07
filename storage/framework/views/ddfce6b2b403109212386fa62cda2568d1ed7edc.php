<?php $__env->startPush('stylesheets'); ?>
	<?php echo Html::style('/css/bootstrap-tagsinput.css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php echo Form::open([
        'url' => isset($tag)
            ? route('rrhh.admin.tags.update', $tag)
            : route('rrhh.admin.tags.store'),
        'method' => 'POST'
    ]); ?>


<?php echo e(Form::hidden('id', isset($tag) ? $tag->id : null)); ?>

<?php echo e(Form::hidden('_method', isset($tag) ? 'PUT' : 'POST')); ?>


<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(route('rrhh.admin.tags.index')); ?>" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> Tag <?php echo e(isset($tag) ? $tag->name : null); ?>

                </h1>

                <div class="float-buttons pull-right">
                    <?php echo Form::submit(Lang::get('architect::fields.save'), [
                            'class' => 'btn btn-primary'
                        ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="container rightbar-page">

    
      <div class="col-md-9 page-content">
		  <div class="form-group <?php echo e($errors->has("name") ? 'has-error' : ''); ?>">
			 <?php echo Form::label('name', 'Nom'); ?>

             <?php echo Form::text('name', isset($tag) ? $tag->name : null, [
                     'class' => 'form-control',
                     'id' => 'name',
                 ]); ?>

          </div>
      </div>

  
      <div class="sidebar">

      </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>