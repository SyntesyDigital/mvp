<?php $__env->startSection('content'); ?>
<div class="container dashboard">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1><?php echo e(Lang::get('architect::home.wellcome')); ?> <?php echo e(Auth::user()->firstname); ?>,</h1>
        <h3><?php echo e(Lang::get('architect::home.current_state')); ?></h3>
      </div>

      <div class="dashboard-items">
        <div class="row">

            <?php if(Auth::user()->hasRole(["admin"])): ?>

              <?php echo $__env->make('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.contents'),
                "value" => Modules\Architect\Entities\Content::all()->count(),
                "icon" => "fa-file-o",
                "route" => route('contents')
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <?php echo $__env->make('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.media'),
                "value" => Modules\Architect\Entities\Media::all()->count(),
                "icon" => "fa-picture-o",
                "route" => route('medias.index')
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <?php echo $__env->make('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.users'),
                "value" => App\Models\User::all()->count(),
                "icon" => "fa-users",
                "route" => route('users')
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <?php echo $__env->make('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.languages'),
                "value" => Modules\Architect\Entities\Language::all()->count(),
                "icon" => "fa-flag",
                "route" => route('languages')
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php endif; ?>

            <div class="col-xs-6">
              <!-- React Table.js -->
              <div id="dashboard-table"
                title=<?php echo e(Lang::get('architect::home.pages')); ?>

                route=<?php echo e(route('contents.modal.data')."?is_page=1"); ?>

              ></div>
            </div>

            <div class="col-xs-6">
              <!-- React Table.js -->
              <div id="dashboard-table"
                title=<?php echo e(Lang::get('architect::home.news')); ?>

                route=<?php echo e(route('contents.modal.data')."?typology_id=2"); ?>

              ></div>
            </div>


            <div class="col-xs-12">
              <!-- React SiteMap.js-->
              <div id="dashboard-sitemap"></div>
            </div>

        </div>
      </div>

    </div>
  </div>

  <div class="separator" style="height:60px;"></div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<?php echo e(Html::script('/modules/architect/js/libs/d3/d3.v4.min.js')); ?>

<script>
var routes = {
  'showContent' : "<?php echo e(route('contents.show',['id' => ':id'])); ?>",
};
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>