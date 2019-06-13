<div class="sidebar">
  <ul>
    <li class="<?php echo e(isset($display_pages) ? 'active' : ''); ?>">
      <a href="<?php echo e(route('contents')); ?>?display_pages=true" > <i class="fa fa-file-o"></i> <span class="text"><?php echo e(Lang::get('architect::fields.pages')); ?></span> </a>
    </li>
  </ul>
  <hr />
  <ul>
    <?php $__currentLoopData = $typologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typology): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($typology_id) && $typology_id == $typology->id): ?>
          <li class="active">
        <?php else: ?>
          <li>
        <?php endif; ?>

          <a href="<?php echo e(route('contents', ['typology_id' => $typology->id])); ?>"><i class="fa <?php echo e($typology->icon); ?>"></i><span class="text"><?php echo e($typology->name); ?></span> </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
  <hr/>
  <ul>
    <li class="<?php echo e(Request::is('architect/media*') ? 'active' : ''); ?>">
      <a href="<?php echo e(route('medias.index')); ?>"> <i class="fa fa-list"></i> <span class="text">Médias</span> </a>
    </li>
  <hr/>
  <ul>
    <li class="<?php echo e(Request::is('architect/categories*') ? 'active' : ''); ?>">
      <a href="<?php echo e(route('categories')); ?>"> <i class="fa fa-list"></i> <span class="text"><?php echo e(Lang::get('architect::category.categories')); ?></span> </a>
    </li>

    <!--li class="<?php echo e(Request::is('architect/tags*') ? 'active' : ''); ?>">
      <a href="<?php echo e(route('tags')); ?>"> <i class="fa fa-tag"></i> <span class="text"><?php echo e(Lang::get('architect::fields.tags')); ?></span> </a>
    </li-->
  </ul>
</div>
