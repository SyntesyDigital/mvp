<?php $__env->startSection('content'); ?>


  <?php echo Form::open([
          'url' => isset($language) ? route('languages.update', $language) : route('languages.store'),
          'method' => 'POST',
      ]); ?>


  <div class="container rightbar-page content">

    <div class="page-bar">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <a href="<?php echo e(route('languages')); ?>" class="btn btn-default btn-close"> <i class="fa fa-angle-left"></i> </a>
            <h1>
              <i class="fa fa-flag"></i>
              <?php echo e(Lang::get('architect::language.new')); ?>

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
                        <a href="<?php echo e(route('languages.create')); ?>">
                            <i class="fa fa-plus-circle"></i>
                            &nbsp;<?php echo e(Lang::get('architect::fields.new')); ?>

                        </a>
                    </li>
                    <?php if(isset($language)): ?>
                    <li>
                        <a href="<?php echo e(route('languages.create')); ?>"
                            class="text-danger"
                            data-toogle="delete"
                            data-ajax="<?php echo e(route('languages.delete', $language)); ?>"
                            data-confirm-message="<?php echo e(Lang::get('architect::language.del_lang_msg')); ?>"
                        >
                            <i class="fa fa-trash text-danger"></i>
                            &nbsp;
                            <span class="text-danger"><?php echo e(Lang::get('architect::fields.delete')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
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

              <?php if($errors->any()): ?>
                  <ul class="alert alert-danger">
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li ><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
              <?php endif; ?>

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


              <?php if(isset($language)): ?>
                  <?php echo Form::hidden('_method', 'PUT'); ?>

              <?php endif; ?>


              <div class="field-item">
                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                      <span class="field-type">
                          <i class="fa fa-font"></i> <?php echo e(Lang::get('architect::fields.text')); ?>

                      </span>
                      <span class="field-name">
                          <?php echo e(Lang::get('architect::fields.name')); ?>

                      </span>
                  </div>

                  <div id="collapse1" class="collapse in" aria-labelledby="heading1" aria-expanded="true" aria-controls="collapse1">
                      <div class="field-form">
                          <div class='form-group bmd-form-group'>
                              <label class="bmd-label-floating"><?php echo e(Lang::get('architect::fields.name')); ?></label>

                              <?php echo Form::text(
                                      'name',
                                      isset($language) ? $language->name : old('name'),
                                      [
                                          'class' => 'form-control'
                                      ]
                                  ); ?>


                          </div>
                      </div>
                  </div>
              </div>

              <div class="field-item">
                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                      <span class="field-type">
                          <i class="fa fa-font"></i> <?php echo e(Lang::get('architect::fields.text')); ?>

                      </span>
                      <span class="field-name">
                           <?php echo e(Lang::get('architect::datatables.iso')); ?>

                      </span>
                  </div>

                  <div id="collapse2" class="collapse in" aria-labelledby="heading1" aria-expanded="true" aria-controls="collapse2">
                      <div class="field-form">
                          <div class='form-group bmd-form-group'>
                              <label class="bmd-label-floating"><?php echo e(Lang::get('architect::datatables.iso')); ?></label>

                              <?php echo Form::text(
                                      'iso',
                                      isset($language) ? $language->iso : old('iso'),
                                      [
                                          'class' => 'form-control'
                                      ]
                                  ); ?>


                          </div>
                      </div>
                  </div>
              </div>

              <div class="field-item">
                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                      <span class="field-type">
                          <i class="fa fa-check-square-o"></i> <?php echo e(Lang::get('architect::fields.boolean')); ?>

                      </span>
                      <span class="field-name">
                          <?php echo e(Lang::get('architect::language.default_question')); ?>


                      </span>
                  </div>

                  <div id="collapse3" class="collapse in" aria-labelledby="heading1" aria-expanded="true" aria-controls="collapse3">
                      <div class="field-form">
                          <div class='form-group bmd-form-group'>
                            <div class='togglebutton'>
                              <label>
                                  <?php echo e(Lang::get('architect::language.default_question')); ?>

                                  <input
                                    type="checkbox"
                                    name="default"
                                    <?php if(isset($language) && $language->default == 1): ?>
                                    checked="true"
                                    <?php endif; ?>
                                  />
                              </label>
                            </div>

                          </div>
                      </div>
                  </div>
              </div>

            </div>
          </div>

      </div>



    </div>

    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugins'); ?>
    <?php echo e(Html::script('/modules/architect/plugins/bootbox/bootbox.min.js')); ?>

    <?php echo e(Html::script('/modules/architect/js/architect.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
<script>
    architect.languages.form.init({
      reloadRoute : "<?php echo e(route('languages')); ?>"
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>