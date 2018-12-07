<?php $__env->startSection('content'); ?>
<!-- React Component Medias/MediaEditModal -->
<div id="media-edit-modal" languages="<?php echo e(Modules\Architect\Entities\Language::getAllCached()); ?>" formats="<?php echo e(json_encode(config('images.formats'))); ?>"></div>

<div class="body medias">

    <div class="row">
        <div class="col-md-offset-1 col-md-10">

            <div class="card">
				<div class="card-body">

                    <h3 class="card-title"><?php echo e(Lang::get('architect::media.list')); ?></h3>
    				        <h6 class="card-subtitle mb-2 text-muted"><?php echo e(Lang::get('architect::media.all_media')); ?></h6>

                    <div class="medias-dropfiles" style="cursor:pointer;">
                        <p align="center" style="pointer-events:none;">
                            <strong><?php echo e(Lang::get('architect::fields.drag_file')); ?></strong> <br />
                            <a href="#" class="btn btn-default"><i class="fa fa-upload"></i> &nbsp; <?php echo e(Lang::get('architect::fields.upload_file')); ?></a>
                        </p>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only"></span>
                      </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-1 col-md-10" style="margin-top:30px;">
            <div class="card">
				<div class="card-body">
                    <table class="table" id="table-medias" data-url="<?php echo e(route('medias.data')); ?>">
                        <thead>
                           <tr>
                               <th></th>
                               <th><?php echo e(Lang::get('architect::fields.filename')); ?></th>
                               <th data-filter="select"><?php echo e(Lang::get('architect::fields.tipus')); ?></th>
                               <th data-filter="select"><?php echo e(Lang::get('architect::fields.author')); ?></th>
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
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugins'); ?>
    <?php echo e(Html::script('/modules/architect/plugins/dropzone/dropzone.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/dropzone/dropzone.min.css')); ?>


    <?php echo e(Html::script('/modules/architect/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/datatables/datatables.min.css')); ?>


    <?php echo e(Html::script('/modules/architect/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/architect.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<script>
    architect.medias.init({
        'identifier' : '.medias-dropfiles',
        'table' : $('#table-medias'),
        'urls': {
          'index' : '<?php echo e(route('medias.index')); ?>',
          'store' : '<?php echo e(route('medias.store')); ?>',
          'show' : '<?php echo e(route('medias.show')); ?>',
          'delete' : '<?php echo e(route('medias.delete')); ?>',
          'update' : '<?php echo e(route('medias.update')); ?>'
        }
    })
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('stylesheets'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>