<?php $__env->startSection('content'); ?>
<?php echo Form::open([
        'url' => isset($sitelist)
            ? route('rrhh.admin.tools.sitelists.update', $sitelist->id)
            : route('rrhh.admin.tools.sitelists.store'),
        'method' => 'POST'
    ]); ?>


<?php echo e(Form::hidden('id', isset($sitelist) ? $sitelist->id : null)); ?>

<?php echo e(Form::hidden('_method', isset($sitelist) ? 'PUT' : 'POST')); ?>


<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(route('rrhh.admin.tools.sitelists.index')); ?>" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> Listes
                </h1>

                <div class="float-buttons pull-right">
                    <a href="" class="btn btn-primary btn-submit-primary">
                        <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder
                    </a>
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

          </div>
      </div>

  
      <div class="sidebar">
          <a href="#" class="btn btn-primary" id="ajouter" onclick="app.sitelist.addNewElement()">
              Ajouter un element à la liste
          </a>
          <hr />
          

          <div class="form-group">
              <label for="name">Titre</label>
              <?php echo Form::text('name', isset($sitelist) ? $sitelist->name : null, [
                      'oninput' => 'app.sitelist.updatePreview();',
                      'class' => 'form-control',
                      'id' => 'name'
                  ]); ?>

          </div>

          <div class="form-group">
             <label for="name">Identifiant</label>
             <?php echo Form::text('identifier', isset($sitelist) ? $sitelist->identifier : null, [
                     'oninput' => 'app.sitelist.updatePreview();',
                     'class' => 'form-control',
                     'id' => 'identifier',
                     'readonly' => 'readonly'
                 ]); ?>

          </div>

          <div class="form-group">
              <label for="type">Type de liste</label>
              <?php echo Form::select('type', [
                      'select' => 'Select',
                      'checkbox' => 'Checkbox',
                      'radios' => 'Radios',
                  ], $sitelist->type, [
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

          <div class="form-group">
              <?php echo Form::open([
                      'url' => route('rrhh.admin.tools.sitelists.delete', $sitelist->id),
                      'method' => 'POST',
                      'class' => 'delete-sitelist-form'
                  ]); ?>

              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Supprimer cette liste" class="btn btn-sm btn-danger" />
              <?php echo e(Form::close()); ?>

          </div>
      </div>

</div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascripts'); ?>
    <script>
    var architect_content = <?php echo isset($sitelist) && $sitelist->definition != "" ? $sitelist->definition:'[]'; ?>;
    </script>
    <?php echo e(Html::script('/modules/rrhh/js/admin/tools/app.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/admin/tools/app.sitelist.js')); ?>

    <script type="text/javascript">
        $( document ).ready(function() {
            app.sitelist.init();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>