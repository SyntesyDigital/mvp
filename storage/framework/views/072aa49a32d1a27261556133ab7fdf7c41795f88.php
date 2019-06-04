<?php $__env->startSection('content'); ?>
<div class="container leftbar-page">
  <div class="col-xs-offset-2 col-xs-8 page-content">

    <h3 class="card-title"><?php echo e(Lang::get('architect::settings.menu')); ?></h3>
    <a href="<?php echo e(route('menu.create')); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; <?php echo e(Lang::get('architect::menus.add')); ?></a>

    <table class="table" id="table" data-url="<?php echo e(route('menu.data')); ?>">
        <thead>
           <tr>
               <th><?php echo e(Lang::get('architect::fields.name')); ?></th>
               <th></th>
           </tr>
        </thead>

        <tbody>
          <tr>
              <th></th>
              <th></th>
          </tr>
        </tbody>
    </table>

  </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('plugins'); ?>
    <?php echo e(Html::script('/modules/architect/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/architect/plugins/bootbox/bootbox.min.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/architect.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<script>
    architect.menu.init({
        'table' : $('#table')
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>