<?php $__env->startSection('content'); ?>
<div class="container leftbar-page">

  <?php echo $__env->make('rrhh::admin.partials.offers-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="col-xs-offset-2 col-xs-10 page-content">

        <h3 class="card-title">Liste des tags</h3>

        <a href="<?php echo e(route('rrhh.admin.tags.create')); ?>" class="pull-right btn btn-primary">
            Ajouter un tag
        </a>

        <h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des tags des offres d'emploi</h6>

        <table class="table" id="table" data-url="<?php echo e(route("rrhh.admin.tags.data")); ?>" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tag</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
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


    <!-- Syntesy Datatable Lib  -->
    <?php echo e(Html::script('/modules/rrhh/js/libs/datatabletools.js')); ?>


    <!-- Toastr -->
    <?php echo e(Html::style('/modules/rrhh/plugins/toastr/toastr.min.css')); ?>

    <?php echo e(Html::script('/modules/rrhh/plugins/toastr/toastr.min.js')); ?>


    <!-- Dialog -->
    <script src="<?php echo e(asset('/modules/rrhh/js/libs/dialog.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<script>
var csrf_token = "<?php echo e(csrf_token()); ?>";
var routes = {
	data : '<?php echo e(route("rrhh.admin.tags.data")); ?>',
};
</script>


<?php echo e(Html::script('/modules/rrhh/js/admin/tags/index.js')); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>