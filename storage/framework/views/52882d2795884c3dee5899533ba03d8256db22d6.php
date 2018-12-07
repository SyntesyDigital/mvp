<?php $__env->startSection('content'); ?>
<div class="body">
    <?php if(isset($sitelists)): ?>
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Listes de formulaire
                        <a href="<?php echo e(route('rrhh.admin.tools.sitelists.create')); ?>" class="pull-right btn btn-primary">
                            Ajouter une liste
                        </a>
                    </h3>
    				<h6 class="card-subtitle mb-2 text-muted">Configuration des listes des formulaires</h6>

                    <table class="table" id="crosslinks-table">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Identifiant</th>
                            <th></th>
                        </tr>
                        <?php $__currentLoopData = $sitelists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td width="50">
                                <?php echo e($sl->id); ?>

                            </td>

                            <td>
                                <a href="<?php echo e(route('rrhh.admin.tools.sitelists.show', $sl->id)); ?>">
                                    <?php echo e($sl->name); ?>

                                </a>
                            </td>

                            <td>
                                <?php echo e($sl->identifier); ?>

                            </td>

                            <td>
                                <a href="<?php echo e(route('rrhh.admin.tools.sitelists.show', $sl->id)); ?>" class="btn btn-sm btn-success pull-right">Modifier</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>