<?php $__env->startSection('content'); ?>
<?php echo Form::open([
        'url' => isset($sitelist)
            ? route('extranet.admin.sitelists.update', $sitelist->id)
            : route('extranet.admin.sitelists.store'),
        'method' => 'POST'
    ]); ?>


<?php echo e(Form::hidden('id', isset($sitelist) ? $sitelist->id : null)); ?>

<?php echo e(Form::hidden('_method', isset($sitelist) ? 'PUT' : 'POST')); ?>


<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(route('extranet.admin.sitelists.index')); ?>" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> Listes
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
                                <a href="<?php echo e(route('extranet.admin.sitelists.create')); ?>">
                                    <i class="fa fa-plus-circle"></i>
                                    &nbsp;<?php echo e(Lang::get('architect::fields.new')); ?>

                                </a>
                            </li>
                            <?php if(isset($sitelist)): ?>
                            <li>
                                <a href="#" id="general-delete-btn" class="text-danger" data-redirection="<?php echo e(route('extranet.admin.sitelists.index')); ?>" data-ajax="<?php echo e(route('extranet.admin.sitelists.delete',$sitelist)); ?>">
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

                </div>
            </div>
        </div>
    </div>
</div>


<div class="container rightbar-page sitelist">

    
      <div class="col-md-9 page-content">
          <div class="card-body jsonbuilder">
            <h3 class="card-title">Définition de la liste</h3>
            <ul class="tabs"></ul>
                <div class="content-field-dropper"  ondrop="app.sitelist.drop(event)" ondragover="app.sitelist.dragover(event)" ></div>

                <?php echo Form::hidden('value', isset($sitelist) ? $sitelist->value : null, [
                        'rows' => 20,
                        'class' => 'form-control'
                    ]); ?>


            <div class="page-row add-row-block">
              <a href="#" class="btn btn-default add-item"><i class="fa fa-plus-circle"></i> Ajouter une ligne</a>
            </div>

          </div>
      </div>

  
      <div class="sidebar">

          <div class="form-group <?php echo e($errors->has("name") ? 'has-error' : ''); ?>">
              <label for="name">Titre</label>
              <?php echo Form::text('name', isset($sitelist) ? $sitelist->name : null, [
                      'oninput' => 'app.sitelist.updatePreview();',
                      'class' => 'form-control',
                      'id' => 'name'
                  ]); ?>

          </div>

          <div class="form-group <?php echo e($errors->has("identifier") ? 'has-error' : ''); ?>">
             <label for="name">Identifiant</label>
             <?php echo Form::text('identifier', isset($sitelist) ? $sitelist->identifier : null, [
                     'oninput' => 'app.sitelist.updatePreview();',
                     'class' => 'form-control',
                     'id' => 'identifier',
                 ]); ?>

          </div>

          <div class="form-group <?php echo e($errors->has("type") ? 'has-error' : ''); ?>">
              <label for="type">Type de liste</label>
              <?php echo Form::select('type', [
                      'select' => 'Select',
                      'checkbox' => 'Checkbox',
                      'radios' => 'Radios',
                  ], isset($sitelist) ? $sitelist->type : null, [
                      'onchange' => 'app.sitelist.updatePreview();',
                      'class' => 'form-control',
                      'id' => 'type',
                  ]); ?>

          </div>

          <hr />
          <h3>Prévisualisation</h3>
          <div id="preview"></div>

          <?php echo e(Form::close()); ?>

          <hr />

          <?php if(isset($sitelist)): ?>
          <div class="form-group">
              <?php echo Form::open([
                      'url' => route('extranet.admin.sitelists.delete', $sitelist->id),
                      'method' => 'POST',
                      'class' => 'delete-sitelist-form',
                      'id' => 'general-delete-form'
                  ]); ?>

              <input type="hidden" name="_method" value="DELETE">
              <?php echo e(Form::close()); ?>

          </div>
        <?php endif; ?>
      </div>

</div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascripts'); ?>
    <script>
    var architect_content = <?php echo isset($sitelist) && $sitelist->definition != "" ? $sitelist->definition:'[]'; ?>;
    </script>
    <?php echo e(Html::script('/modules/extranet/js/admin/tools/app.js')); ?>

    <?php echo e(Html::script('/modules/extranet/js/admin/tools/app.sitelist.js')); ?>

    <script type="text/javascript">
        $( document ).ready(function() {
            app.sitelist.init();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>