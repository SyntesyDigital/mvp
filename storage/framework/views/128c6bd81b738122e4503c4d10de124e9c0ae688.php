<?php $__env->startSection('content'); ?>
  <div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
			          <div class="card-body">

                    <h3 class="card-title">Parametres
                        <a href="<?php echo e(route('extranet.routes_parameters.create')); ?>" class="pull-right btn btn-primary">
                            Ajouter Parametres
                        </a>
                    </h3>

                    <table class="table" id="table-routes-parameters" style="width:100%">
                        <thead>
                           <tr>
                               <th>Identifiant</th>
                               <th>Nom</th>
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
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascripts-libs'); ?>
    <!-- Datatables -->
    <?php echo e(Html::style('/modules/extranet/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/extranet/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(Html::script('/modules/extranet/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/extranet/js/libs/dialog.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
    <script>
    var csrf_token = "<?php echo e(csrf_token()); ?>";
    var routes = {
        data : '<?php echo e(route("extranet.routes_parameters.data")); ?>',
    };
    </script>

    <?php echo e(Html::script('/modules/extranet/js/admin/extranet/parameterslist.js')); ?>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>