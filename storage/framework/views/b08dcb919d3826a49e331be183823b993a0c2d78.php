<?php $__env->startSection('content'); ?>
<div class="container leftbar-page">

  <?php echo $__env->make('rrhh::admin.partials.offers-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="col-xs-offset-2 col-xs-10 page-content">

        <h3 class="card-title">Liste des candidatures spontanées</h3>
        <h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des candidatures spontanées</h6>

        <table class="table" id="table" data-url="<?php echo e(route("rrhh.admin.applications.spontaneous.data")); ?>">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Prénom</th>
                    <th>Code postal</th>
                    <th>Localité</th>
                    <th data-filter="select" data-values="<?php echo base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Candidate::getTypes())); ?>">Type</th>
                    <th>Date de candidature</th>
                    <th data-filter="select" data-values="<?php echo base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Application::getStatus())); ?>">Etat</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
    <!-- Datatables -->
    <?php echo e(Html::style('/modules/rrhh/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/rrhh/plugins/datatables/datatables.min.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
    <?php echo e(Html::script('/modules/rrhh/js/libs/dialog.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/admin/applications/spontaneous.js')); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>