<?php $__env->startSection('content'); ?>

    <?php echo Form::open([
            'url' => isset($category) ? route('categories.update', $category) : route('categories.store'),
            'method' => 'POST',
        ]); ?>


    <div class="container rightbar-page content">


      <div class="page-bar">
        <div class="container">
          <div class="row">

            <div class="col-md-12">
              <a href="<?php echo e(route('categories')); ?>" class="btn btn-default btn-close"> <i class="fa fa-angle-left"></i> </a>
              <h1>
                <i class="fa fa-list "></i>
                <?php if(isset($category)): ?>
                  <?php echo e(Lang::get('architect::category.edit')); ?> <?php echo e(isset($category->name) ? $category->name : ''); ?>

                <?php else: ?>
                  <?php echo e(Lang::get('architect::category.new')); ?>

                <?php endif; ?>
              </h1>

              <div class="float-buttons pull-right">

              <div class="actions-dropdown">
                <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
                  <?php echo e(Lang::get('architect::fields.actions')); ?>

                  <b class="caret"></b>
                  <div class="ripple-container"></div>
                </a>
                  <ul class="dropdown-menu dropdown-menu-right default-padding">
                      <li class="dropdown-header"></li>
                      <li>
                          <a href="<?php echo e(route('categories.create')); ?>">
                              <i class="fa fa-plus-circle"></i>
                              &nbsp;<?php echo e(Lang::get('architect::fields.new')); ?>

                          </a>
                      </li>
                      <li>
                          <a href="<?php echo e(route('account')); ?>" class="text-danger">
                              <i class="fa fa-trash text-danger"></i>
                              &nbsp;
                              <span class="text-danger"><?php echo e(Lang::get('architect::fields.delete')); ?></span>
                          </a>
                      </li>
                  </ul>
                </div>


                <?php echo Form::submit(Lang::get('architect::fields.save'), [
                        'class' => 'btn btn-primary'
                    ]); ?>


                <!--
                <a href="" class="btn btn-primary" > <i class="fa fa-cloud-upload"></i> &nbsp; Guardar </a>
                -->
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="container rightbar-page content">

        <div class="col-xs-8 col-xs-offset-2 page-content">
          <div class="field-group">

              <?php if(session('success')): ?>
                  <div class="alert alert-success">
                      <?php echo e(session('success')); ?>

                  </div>
              <?php endif; ?>

              <?php if(session('error')): ?>
                  <div class="alert alert-danger">
                      <?php echo e(session('error')); ?>

                  </div>
              <?php endif; ?>

              <?php if(isset($category)): ?>
                  <?php echo Form::hidden('_method', 'PUT'); ?>

              <?php endif; ?>

              <div class="field-group">

                  <?php $__currentLoopData = Modules\Architect\Entities\Category::FIELDS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php switch($field["type"]):
                          case ('text'): ?>
                              <div class="field-item">
                                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo e($field['identifier']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($field['identifier']); ?>">
                                      <span class="field-type">
                                          <i class="fa fa-font"></i> <?php echo e(ucfirst($field['type'])); ?>

                                      </span>
                                      <span class="field-name">
                                          <?php echo e($field['name']); ?>

                                      </span>
                                  </div>

                                  <div id="collapse<?php echo e($field['identifier']); ?>" class="collapse in" aria-labelledby="heading<?php echo e($field['identifier']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($field['identifier']); ?>">
                                      <div class="field-form">
                                          <?php $__currentLoopData = Modules\Architect\Entities\Language::getAllCached(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class='form-group bmd-form-group'>
                                                  <label class="bmd-label-floating"><?php echo e($field['name']); ?> - <?php echo e($language->name); ?></label>
                                                  <?php
                                                      $fieldName = "fields[" . $field['name'] . "][" . $language->id . "]";
                                                  ?>
                                                  <?php echo Form::text(
                                                          $fieldName,
                                                          isset($category) ? $category->getFieldValue($field['identifier'], $language->id) : old($fieldName),
                                                          [
                                                              'class' => 'form-control input-source',
                                                              'data-lang' => $language->iso
                                                          ]
                                                      ); ?>

                                              </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </div>
                                  </div>
                              </div>
                          <?php break; ?>

                          <?php case ('slug'): ?>
                              <div class="field-item">
                                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo e($field['identifier']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($field['identifier']); ?>">
                                      <span class="field-type">
                                          <i class="fa fa-font"></i> <?php echo e(ucfirst($field['type'])); ?>

                                      </span>
                                      <span class="field-name">
                                          <?php echo e($field['name']); ?>

                                      </span>
                                  </div>

                                  <div id="collapse<?php echo e($field['identifier']); ?>" class="collapse in" aria-labelledby="heading<?php echo e($field['identifier']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($field['identifier']); ?>">
                                      <div class="field-form">
                                          <?php $__currentLoopData = Modules\Architect\Entities\Language::getAllCached(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class='form-group bmd-form-group'>
                                                  <label class="bmd-label-floating"><?php echo e($field['name']); ?> - <?php echo e($language->name); ?></label>
                                                  <?php
                                                      $fieldName = "fields[" . $field['name'] . "][" . $language->id . "]";
                                                  ?>
                                                  <?php echo Form::text(
                                                          $fieldName,
                                                          isset($category) ? $category->getFieldValue($field['identifier'], $language->id) : old($fieldName),
                                                          [
                                                            'class' => 'form-control input-target ',
                                                            'data-lang' => $language->iso
                                                          ]
                                                      ); ?>

                                              </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </div>
                                  </div>
                              </div>
                          <?php break; ?>

                          <?php case ('richtext'): ?>
                              <div class="field-item">
                                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo e($field['identifier']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($field['identifier']); ?>">
                                      <span class="field-type">
                                          <i class="fa fa-font"></i> <?php echo e(ucfirst($field['type'])); ?>

                                      </span>
                                      <span class="field-name">
                                          <?php echo e($field['name']); ?>

                                      </span>
                                  </div>

                                  <div id="collapse<?php echo e($field['identifier']); ?>" class="collapse in" aria-labelledby="heading<?php echo e($field['identifier']); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($field['identifier']); ?>">
                                      <div class="field-form">
                                          <?php $__currentLoopData = Modules\Architect\Entities\Language::getAllCached(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class='form-group bmd-form-group'>
                                                  <label class="bmd-label-floating"><?php echo e($field['name']); ?> - <?php echo e($language->name); ?></label>
                                                  <?php
                                                      $fieldName = "fields[" . $field['name'] . "][" . $language->id . "]";
                                                  ?>
                                                  <?php echo Form::textarea(
                                                          $fieldName,
                                                          isset($category) ? $category->getFieldValue($field['identifier'], $language->id) : old($fieldName),
                                                          [
                                                              'class' => 'form-control',
                                                          ]
                                                      ); ?>

                                              </div>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </div>
                                  </div>
                              </div>
                          <?php break; ?>

                      <?php endswitch; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <div class="field-item">
                      <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse_parent_id" aria-expanded="true" aria-controls="collapse_parent_id">
                          <span class="field-type">
                              <i class="fa fa-font"></i> <?php echo e(Lang::get('architect::fields.category')); ?>

                          </span>
                          <span class="field-name">
                             <?php echo e(Lang::get('architect::category.parent')); ?>

                          </span>
                      </div>

                      <div id="collapse_parent_id" class="collapse in" aria-labelledby="heading-collapse" aria-expanded="true" aria-controls="collapse-collapse">
                          <div class="field-form">
                              <?php

                                  if(isset($category)) {
                                      unset($categories[$category->id]);
                                  }

                              ?>



                              <?php echo Form::select(
                                      'parent_id',
                                      array_merge([""=>"---"],$categories),
                                      isset($category) ? $category->parent_id : null,
                                      [
                                          'class' => 'form-control'
                                      ]
                                  ); ?>

                          </div>
                      </div>
                  </div>

                  <br/>
                  <br/>
                  <br/>
                  <br/>

                </div>

              </div>
            </div>

          </div>

      </div>

      <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts-libs'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<script>

  $(function(){

    var slugifyTitle = function(sourceValue){
      return slugify(sourceValue, {
				replacement: '-',
				remove: /[$*+~.,()'"!\-\?\¿`´:@]/g,
				lower: true
			});
    };

    $(".input-source").keyup(function(e){
      var isoCode = $(e.target).data('lang');
      var slug = slugifyTitle(e.target.value);
      $(".input-target[data-lang='"+isoCode+"']").val(slug);

    });

  });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>