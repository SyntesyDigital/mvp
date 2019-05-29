<?php $__env->startSection('content'); ?>
<div class="container leftbar-page">

  <?php echo $__env->make('rrhh::admin.partials.offers-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <div class="col-xs-offset-2 col-xs-10 page-content">

    <!--h3 class="card-title"> <?php echo e(Lang::get('architect::contents.contents')); ?></h3-->
    <h3 class="card-title">Liste des offres d'emploi</h3>
    <a href="<?php echo e(route('rrhh.admin.offers.create')); ?>" class="pull-right btn btn-primary">
        Ajouter une offre
    </a>

    <h6 class="card-subtitle mb-2 text-muted">Retrouvez-ici l'ensemble des offres d'emploi</h6>

            <table class="table" id="table" data-url="<?php echo e(route("rrhh.admin.offers.index.data")); ?>" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Date de création</th>
                        <th data-filter="select" data-values="<?php echo base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Offer::getStatus())); ?>">Etat</th>
                        <th>Nombre de candidatures</th>
                        <th data-filter="select" data-ajax="<?php echo e(route("rrhh.admin.offers.index.data.recipients")); ?>">Destinataire interne</th>
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
                    </tr>
                </tfoot>
            </table>

  </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts'); ?>
<script>
var csrf_token = "<?php echo e(csrf_token()); ?>";
var routes = {
	data : '<?php echo e(route("rrhh.admin.offers.index.data")); ?>',
    recipients: '<?php echo e(route("rrhh.admin.offers.index.data.recipients")); ?>'
};
</script>

<?php echo e(Html::script('js/libs/datatabletools.js')); ?>

<?php echo e(Html::script('js/admin/offers/index.js')); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>