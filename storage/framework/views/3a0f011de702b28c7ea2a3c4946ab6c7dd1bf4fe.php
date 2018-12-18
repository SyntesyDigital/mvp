<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    
    <?php if(isset($item['group'])): ?>
        <?php if(config($item['name'])): ?>
            <?php echo $__env->make('architect::partials.topbar-menu', [
                'items' => config($item['name'])
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php continue; ?>;
    <?php endif; ?>

    
    <?php if(!empty($item['roles'])): ?>
        <?php if(!Auth::user()->hasRole([$item['roles']])): ?>
            <?php continue; ?>;
        <?php endif; ?>
    <?php endif; ?>

    
    <?php if(!empty($item['patterns'])): ?>
        <?php
            $isActive = collect($item['patterns'])->filter(function($pattern){
                return Request::is($pattern) ? true : false;
            })->first();
        ?>
    <?php endif; ?>

    
    <li class="<?php echo e($isActive ? 'active' : false); ?>">
        <a href="<?php echo e(route($item['route'])); ?>">
            <?php echo e(Lang::get($item['label'])); ?>

        </a>
    </li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
