<?php $__env->startSection('content'); ?>

<?php echo Form::open([
        'url' => isset($route_parameter)
            ? route('extranet.routes_parameters.update', $route_parameter)
            : route('extranet.routes_parameters.store'),
        'method' => 'POST'
    ]); ?>


<?php echo e(Form::hidden('id', isset($route_parameter) ? $route_parameter->id : null)); ?>

<?php echo e(Form::hidden('_method', isset($route_parameter) ? 'PUT' : 'POST')); ?>


<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(route('extranet.routes_parameters.index')); ?>" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> Parametre <?php echo e(isset($route_parameter) ? $route_parameter->name : null); ?>

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

    

        <div class="col-md-8 page-content">
    		  <div class="form-group <?php echo e($errors->has("identifier") ? 'has-error' : ''); ?>">
      			 <?php echo Form::label('identifier', 'Identifier'); ?>

               <?php echo Form::text('identifier', isset($route_parameter) ? $route_parameter->identifier : null, [
                       'class' => 'form-control',
                       'id' => 'identifier',
                   ]); ?>

          </div>
          <div class="form-group <?php echo e($errors->has("name") ? 'has-error' : ''); ?>">
      			 <?php echo Form::label('name', 'Nom'); ?>

               <?php echo Form::text('name', isset($route_parameter) ? $route_parameter->name : null, [
                       'class' => 'form-control',
                       'id' => 'name',
                   ]); ?>

          </div>
      </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>