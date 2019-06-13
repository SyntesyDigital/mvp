<?php $__env->startSection('content'); ?>

<?php echo $__env->make('architect::contents.modal-new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="container leftbar-page">

  <?php echo $__env->make('architect::partials.content-nav',[
    'typologies' => $typologies,
    'typology_id' => Request('typology_id'),
    'display_pages' => Request('display_pages')
  ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <div class="col-xs-offset-2 col-xs-10 page-content">

    <h3 class="card-title"> <?php echo e(Lang::get('architect::contents.contents')); ?></h3>
    <a href="#" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; <?php echo e(Lang::get('architect::contents.add')); ?></a>

    <table class="table" id="table-contents" data-url="<?php echo e(route('contents.data', request()->all())); ?>">
        <thead>
           <tr>
               <th> <?php echo e(Lang::get('architect::fields.name')); ?></th>
               <th><?php echo e(Lang::get('architect::fields.tipus')); ?></th>
               <th><?php echo e(Lang::get('architect::fields.updated')); ?></th>
               <th><?php echo e(Lang::get('architect::fields.status')); ?></th>
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


<?php $__env->startPush('plugins'); ?>
    <?php echo e(Html::script('/modules/architect/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(HTML::style('/modules/architect/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/architect/plugins/bootbox/bootbox.min.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/libs/datatabletools.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/architect.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<script>
    architect.contents.init({
        'table' : $('#table-contents'),
        'urls': {
            'index' : '<?php echo e(route('contents.data')); ?>',
            'store' : '<?php echo e(route('contents.store')); ?>',
            'show' : '<?php echo e(route('contents.show')); ?>',
            'delete' : '<?php echo e(route('contents.delete')); ?>',
            'update' : '<?php echo e(route('contents.update')); ?>'
        }
    })
</script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('javascripts'); ?>

<script>
$(function(){

  $(".btn-primary").click(function(e){
    e.preventDefault();
    TweenMax.to($("#new-content-modal"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
  });

  $(document).on('click',"#new-content-modal .close-btn",function(e){
    e.preventDefault();
    TweenMax.to($("#new-content-modal"),0.5,{opacity:0,display:"none",ease:Power2.easeInOut});
  });

});
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>