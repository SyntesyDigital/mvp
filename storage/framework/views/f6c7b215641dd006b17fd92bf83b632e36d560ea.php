<?php $__env->startSection('content'); ?>
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Listes des e-mails type
                        <a href="<?php echo e(route('rrhh.admin.emailstemplates.create')); ?>" class="pull-right btn btn-primary">
                            Ajouter un template
                        </a>
                    </h3>
    				<h6 class="card-subtitle mb-2 text-muted">Configuration des listes des formulaires</h6>

                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Identifiant</th>
                            <th></th>
                        </tr>
                        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td width="50">
                                <?php echo e($template->id); ?>

                            </td>

                            <td>
                                <a href="<?php echo e(route('rrhh.admin.emailstemplates.show', $template)); ?>">
                                    <?php echo e($template->subject); ?>

                                </a>
                            </td>

                            <td>
                                <?php echo e($template->identifier); ?>

                            </td>

                            <td class="text-right">
                                <?php echo Form::open([
                                        'url' => route('rrhh.admin.emailstemplates.delete', $template),
                                        'method' => 'POST',
                                        'class' => 'toggle-delete'
                                    ]); ?>

                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Supprimer" class="btn btn-sm btn-danger" />
                                    <a href="<?php echo e(route('rrhh.admin.emailstemplates.show', $template)); ?>" class="btn btn-sm btn-success">Modifier</a>
                                <?php echo Form::close(); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>