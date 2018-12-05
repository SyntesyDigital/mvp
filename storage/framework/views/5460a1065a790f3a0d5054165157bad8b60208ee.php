<?php
  $allTags = Modules\RRHH\Entities\Tag::orderBy('name')->get()->pluck('name');
?>
<?php $__env->startSection('content'); ?>
<div class="container leftbar-page">

  <?php echo $__env->make('rrhh::admin.partials.offers-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <div class="col-xs-offset-2 col-xs-10 page-content">

          <h3 class="card-title">Liste des candidats</h3>
              <a href="<?php echo e(route('rrhh.admin.candidates.create')); ?>" class="pull-right btn btn-primary">
                  Ajouter un candidat
              </a>

          <h6 class="card-subtitle mb-2 text-muted">Tous les candidats</h6>
          <div class="filter-tags-container">
            <div class="input-div">
              <label>Tags
              <textarea type="text" name="tags"  id="textarea" class="example" rows="1"></textarea>
              </label>
            </div>
           <br clear="all">

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
    <script>
    var csrf_token = "<?php echo e(csrf_token()); ?>";
    var routes = {
        data : '<?php echo e(route("rrhh.admin.candidates.data")); ?>',
    };
    var table_candidats = '';
    </script>


    <script>
      var atags = [];
      <?php $__currentLoopData = $allTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          atags.push('<?php echo e($at); ?>');
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>

    <?php echo e(Html::script('/js/admin/users/candidateslist.js')); ?>

    <?php echo e(Html::script('/js/textext.core.js')); ?>

    <?php echo e(Html::script('/js/textext.plugin.autocomplete.js')); ?>

    <?php echo e(Html::script('/js/textext.plugin.tags.js')); ?>

    <?php echo e(Html::script('/modules/architect/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/architect/js/libs/datatabletools.js')); ?>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
