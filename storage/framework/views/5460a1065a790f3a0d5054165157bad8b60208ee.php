<?php
  $allTags = Modules\RRHH\Entities\Tag::orderBy('name')->get()->pluck('name');
?>
<?php $__env->startSection('content'); ?>
<div class="container leftbar-page">

  <?php echo $__env->make('rrhh::admin.partials.offers-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <div class="col-xs-offset-2 col-xs-10 page-content">

          <h3 class="card-title">
            Liste des candidats &nbsp;
          </h3>
          <a href="<?php echo e(route('rrhh.admin.candidates.create')); ?>" class="btn btn-primary pull-right">
              <i class="fa fa-plus-circle"></i>&nbsp; Ajouter un candidat
          </a>

          <div class="form-group tags-filter">
            <label>Filter by tags</label>
            <?php echo Form::select(
                    'tags[]',
                    \Modules\RRHH\Entities\Tag::pluck('name', 'id'),
                    null,
                    [
                        'class' => 'form-control toggle-select2',
                        'multiple' => 'multiple'
                    ]
                ); ?>

          </div>



          <br clear="all">
          <table class="table" id="table-candidates" style="width:100%">
            <thead>
               <tr>
                   <th>#</th>
                   <th>Nom</th>
                   <th data-filter="select" data-values="<?php echo base64_encode(json_encode(\App\Models\User::getStatus())); ?>">Etat</th>
                   <th>Code postal</th>
                   <th>Localisation</th>
                   <th data-filter="select" data-values="<?php echo base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Candidate::getTypes())); ?>">Type</th>
                   
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

    <?php echo e(Html::script('/modules/rrhh/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/libs/dialog.js')); ?>

    <?php echo e(Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js')); ?>


    <!-- Select2 -->
    <?php echo e(Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css')); ?>

    <?php echo e(Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js')); ?>


<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
    <script>
        var csrf_token = "<?php echo e(csrf_token()); ?>";
        var routes = {
            data : '<?php echo e(route("rrhh.admin.candidates.data")); ?>',
        };
        var atags = [];

        <?php $__currentLoopData = $allTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            atags.push('<?php echo e($at); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

    <?php echo e(Html::script('/modules/rrhh/js/admin/users/candidateslist.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/textext.core.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/textext.plugin.autocomplete.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/textext.plugin.tags.js')); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>