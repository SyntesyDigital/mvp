<?php $__env->startSection('content'); ?>

<?php echo Form::open([
        'url' => isset($template)
            ? route('rrhh.admin.emailstemplates.update', $template)
            : route('rrhh.admin.emailstemplates.store'),
        'method' => 'POST'
    ]); ?>


<input type="hidden" name="id" value="<?php echo e(isset($template->id) ? $template->id : ''); ?>" />
<input type="hidden" name="_method" value="<?php echo e(isset($template) ? 'PUT' : 'POST'); ?>">

<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(route('rrhh.admin.sitelists.index')); ?>" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> <?php echo e(Lang::get('rrhh::settings.emailstemplates')); ?>

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
      <div class="card-body jsonbuilder">
        <div class="form-group">
            <label>Sujet</label>
            <?php echo Form::text(
                    'subject',
                    isset($template) ? $template->subject : null,
                    [
                        'class' => 'form-control'
                    ]
                ); ?>

        </div>

        <div class="form-group">
            <label>Corps du mail</label>
            <?php echo Form::textarea(
                    'body',
                    isset($template) ? $template->body : null,
                    [
                        'class' => 'form-control'
                    ]
                ); ?>

        </div>
      </div>
    </div>

    
    <div class="sidebar">
        <h3>Modèle d'email</h3>
        <div class="form-group">
        <?php echo Form::select('identifier', config('emails_templates'),isset($template) ? $template->identifier : null, [
                'class' => 'form-control',
                'placeholder' => '---'
            ]); ?>

        </div>
    </div>
</div>
<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>