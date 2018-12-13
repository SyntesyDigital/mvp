<?php $__env->startSection('content'); ?>

    <?php echo Form::open([
            'url' => isset($user)
                ? route('rrhh.admin.candidates.update', $user)
                : route('rrhh.admin.candidates.store'),
            'method' => 'POST',
            'class' => 'check-inactive-candidate-form'
        ]); ?>


        <input type="hidden" name="id" value="<?php echo e(isset($user->id) ? $user->id : ''); ?>" />
        <input type="hidden" name="_method" value="<?php echo e(isset($user) ? 'PUT' : 'POST'); ?>">

        <div class="page-bar">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
                <h1><i class="fa fa-newspaper-o"></i>&nbsp;Candidates</h1>
                <div class="float-buttons pull-right">

                  <div class="actions-dropdown">
                      <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
                        <?php echo e(Lang::get('architect::fields.actions')); ?>

                        <b class="caret"></b>
                        <div class="ripple-container"></div>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-right default-padding">
                          <li class="dropdown-header"></li>
                          <!--li>
                              <a href="<?php echo e(route('categories.create')); ?>">
                                  <i class="fa fa-plus-circle"></i>
                                  &nbsp;<?php echo e(Lang::get('architect::fields.new')); ?>

                              </a>
                          </li-->
                          <li>
                              <a href="<?php echo e(route('rrhh.admin.candidates.delete', $user->id)); ?>" class="text-danger">
                                  <i class="fa fa-trash text-danger"></i>
                                  &nbsp;
                                  <span class="text-danger"><?php echo e(Lang::get('architect::fields.delete')); ?></span>
                              </a>
                          </li>
                      </ul>
                    </div>


                  <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
                </div>
              </div>
            </div>
          </div>
        </div>


          <div class="container rightbar-page">

            <div class="col-md-9 page-content">

              <h3 class="card-title">Edition du candidat <?php echo e(isset($user) ? $user->full_name :''); ?></h3>

              <div class="form-group">
                  <label for="civility">Civilité</label>

                  <div class="radio" style="display: inline; margin-left:20px;">
                      <label style="font-size: .8em">
                           <input type="radio"  name="civility"  value="<?php echo e(Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE); ?>" <?php echo e(isset($user) && $user->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE  ?'checked':''); ?>>Monsieur
                      </label>
                      <label style="font-size: .8em">
                          <input type="radio" name="civility" value="<?php echo e(Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE); ?>" <?php echo e(isset($user) && $user->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE  ?'checked':''); ?>>Madame
                      </label>
                  </div>
              </div>
              <div class="form-group">
                  <label for="name">Nom</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="<?php echo e(isset($user->lastname) ? $user->lastname : ''); ?>">
              </div>
              <div class="form-group">
                  <label for="name">Prénom</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" value="<?php echo e(isset($user->firstname) ? $user->firstname : ''); ?>">
              </div>

              <div class="form-group">
                  <label for="name">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="" value="<?php echo e(isset($user->email) ? $user->email : ''); ?>">
              </div>

              <div class="form-group">
                  <label for="name">Mot de passe</label>
                  <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="" value="<?php echo e(''); ?>">
              </div>
              <div class="form-group">
                  <label for="name">Telephone</label>
                  <input type="text" class="form-control" id="telephone" name="telephone" placeholder="" value="<?php echo e(isset($user->telephone) ? $user->telephone : ''); ?>">
              </div>

              <div class="form-group">
                  <?php echo Form::label('address', 'Adresse'); ?>

                  <?php echo Form::text('address', isset($user->candidate->address)? $user->candidate->address:'', [
                          'class' => 'form-control',
                          'id' => 'address'
                      ]); ?>

              </div>

              <div class="form-group">
                  <?php echo Form::label('postal_code', 'Code Postal'); ?>

                  <?php echo Form::text('postal_code', isset($user->candidate->postal_code) ?$user->candidate->postal_code:'', [
                          'class' => 'form-control',
                          'id' => 'postal_code'
                      ]); ?>

              </div>

              <div class="form-group">
                  <?php echo Form::label('location', 'Localité'); ?>

                  <?php echo Form::text('location', isset($user->candidate->location) ? $user->candidate->location:'', [
                          'class' => 'form-control',
                          'id' => 'location'
                      ]); ?>

              </div>

              <div class="form-group">
                  <?php echo Form::label('country', 'Pays'); ?>

                  <?php echo $__env->make('rrhh::front.partials.countries', ['default' => isset($user->candidate->country) ? $user->candidate->country:null], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              </div>

              <div class="form-group">
                  <?php echo Form::label('birthday', 'Date de naissance'); ?>

                  <?php if( isset($user) && $user->candidate->birthday != null): ?>
                      <?php
                          $date = explode('-',$user->candidate->birthday);
                          $date_formated = $date[2].'/'.$date[1].'/'.$date[0];
                      ?>
                  <?php endif; ?>
                  <?php echo Form::text('birthday', isset($user) && $user->candidate->birthday != null? $date_formated:'', [
                          'class' => 'form-control',
                          'id' => 'birthday'
                      ]); ?>

              </div>

              <div class="form-group">
                  <?php echo Form::label('birthplace', 'Ĺieu de naissance'); ?>

                  <?php echo Form::text('birthplace', isset($user->candidate->birthplace) ? $user->candidate->birthplace:'', [
                          'class' => 'form-control',
                          'id' => 'birthplace'
                      ]); ?>

              </div>

              <div class="form-group">
                  <?php echo Form::label('comment', 'Commentaire'); ?>

                  <?php echo Form::textarea('comment',  isset($user->candidate->comment) ? $user->candidate->comment:'', [
                          'class' => 'form-control',
                          'rows' => 3,
                          'id' => 'comment'
                      ]); ?>

              </div>

              <div class="form-group">
                  <label for="status">Etat</label>
                  <select name="status" id="status" class="form-control" >
                      <option value="<?php echo e(App\Models\User::STATUS_ACTIVE); ?>" <?php if(isset($user)): ?> <?php if($user->status == App\Models\User::STATUS_ACTIVE): ?> selected <?php endif; ?> <?php endif; ?>>Actif</option>
                      <option value="<?php echo e(App\Models\User::STATUS_INACTIVE); ?>" <?php if(isset($user)): ?> <?php if($user->status == App\Models\User::STATUS_INACTIVE): ?> selected <?php endif; ?> <?php endif; ?>>Désactivé</option>
                  </select>
              </div>

              <?php if(isset($user)): ?>
                  <div class="form-group">
                      <label for="registration_number" style="display: block;">Matricule</label>
                      <?php if($user->candidate->type == Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM): ?>
                          <div class="row">
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo e($user->candidate->registration_number); ?>" >
                              </div>
                              <div class="col-sm-6">
                                  <p>Intérimaire depuis le <?php echo e($user->candidate->registered_at); ?></p>
                              </div>
                          </div>
                      <?php else: ?>
                          <div class="row">
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo e(isset($user->candidate->registration_number) ? $user->candidate->registration_number : ''); ?>" >
                              </div>
                              <div class="col-sm-6">
                                  <input value="Convertir en intérimaire" type="button" class="btn btn-sm btn-primary pull-right convert_interimaire" />
                              </div>
                          </div>
                      <?php endif; ?>
                  </div>
              <?php else: ?>
                  <input type="hidden" name="registration_number" value="" >
              <?php endif; ?>
              <input type="hidden" name="type" id="type" value="<?php echo e(isset($user->candidate->type) && $user->candidate->type!=''?$user->candidate->type:Modules\RRHH\Entities\Offers\Candidate::TYPE_NORMAL); ?>" >

              <div class="form-group">
                  <label for="name">C.V.</label>

                  <?php if(isset($user) && $user->candidate->resume_file != ''): ?>
                      <?php $display_1 = 'display:none'; ?>
                      <small class="filename-small" id="filename-p_1">
                          <i class='fa fa-file'>
                              <a href="/storage/candidates/<?php echo e($user->candidate->resume_file); ?>" target="_blank"><?php echo e($user->candidate->resume_file); ?></a>
                          </i>
                          <i class='fa fa-remove remove-file-click' onclick="deleteFile('1')"></i>
                      </small>
                  <?php else: ?>
                      <?php $display_1 = ''; ?>
                      <small class="filename-small" id="filename-p_1"></small>
                  <?php endif; ?>

                  <div class="medias-dropfiles medias-dropfiles_1 dz-div dz-div_1" style="<?php echo e($display_1); ?>">
                      <p align="center">
                          <strong>Déposez vos fichiers</strong> <br />
                          <small>ou cliquez-ici</small>
                      <p>
                  </div>
                  <div class="progress dz-div dz-div_1" style="<?php echo e($display_1); ?>">
                      <div class="progress-bar progress-bar_1" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100" style="width:0%">
                      <span class="sr-only">70% Complete</span>
                      </div>
                  </div>
              </div>

              <div class="form-group">
                  <label for="name">Lettre de recommandation</label>

                  <?php if(isset($user) && $user->candidate->recommendation_letter != ''): ?>
                      <?php $display_2 = 'display:none'; ?>
                      <small class="filename-small" id="filename-p_2">
                          <i class='fa fa-file'>
                              <a href="/storage/candidates/<?php echo e($user->candidate->recommendation_letter); ?>" target="_blank"><?php echo e($user->candidate->recommendation_letter); ?></a>
                          </i>
                          <i class='fa fa-remove remove-file-click' onclick="deleteFile('2')"></i>
                      </small>
                  <?php else: ?>
                      <?php $display_2 = ''; ?>
                      <small class="filename-small" id="filename-p_2"></small>

                  <?php endif; ?>

                  <div class="medias-dropfiles medias-dropfiles_2 dz-div dz-div_2" style="<?php echo e($display_2); ?>">
                      <p align="center">
                          <strong>Déposez vos fichiers</strong> <br />
                          <small>ou cliquez-ici</small>
                      <p>
                  </div>

                  <div class="progress dz-div dz-div_2" style="<?php echo e($display_2); ?>">
                    <div class="progress-bar progress-bar_2" role="progressbar" aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100" style="width:0%">
                      <span class="sr-only">70% Complete</span>
                    </div>
                  </div>
                  <small id="filename-p_2"></small>
              </div>
              <input type="hidden" id="resume_file" name="resume_file" value="<?php echo e(isset($user->candidate->resume_file) ? $user->candidate->resume_file : ''); ?>" >
              <input type="hidden" id="recommendation_letter" name="recommendation_letter" value="<?php echo e(isset($user->candidate->recommendation_letter) ? $user->candidate->recommendation_letter : ''); ?>" >
              <input type="hidden" name="old_status" id="old_status" value="<?php echo e(isset( $user) && $user->status == App\Models\User::STATUS_ACTIVE ? App\Models\User::STATUS_ACTIVE:App\Models\User::STATUS_INACTIVE); ?>" />
              <input type="hidden" name="role_id" id="role_id" value="<?php echo e(App\Models\Role::where('name','candidate')->first()->id); ?>" />
          </div>

          <div class="sidebar">
          <?php if(isset($user)): ?>

          <?php echo Form::open([
                  'url' => route('rrhh.admin.candidates.updatetags', $user),
                  'method' => 'POST'
                  ]); ?>

              <div class="card" style="margin-bottom:30px;">
                  <div class="card-body">
                      <h3 class="card-title">Tags</h3>
                      <textarea type="text" name="tags"  id="textarea" class="example" rows="1"></textarea>
                      <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />
                  </div>
              </div>

              <h3 class="card-title">Candidatures</h3>

              <table class="table" id="table-candidatures">
                 <thead>
                     <tr>
                         <th>Titre</th>
                         <th>Date de création</th>
                         <th>Etat</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                         <th></th>
                         <th></th>
                         <th></th>
                     </tr>
                 </tfoot>
             </table>
          <?php echo e(Form::close()); ?>


          <?php endif; ?>
        </div>

        </div>

    <?php echo e(Form::close()); ?>




<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('javascripts'); ?>
    <?php echo e(Html::script('/js/admin/content/contents/vendors/dropzone/dropzone.js')); ?>


    <script>
        var inactive_value = '<?php echo e(App\Models\User::STATUS_INACTIVE); ?>';
        var type_interim_value = '<?php echo e(Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM); ?>';
        var csrf_token = "<?php echo e(csrf_token()); ?>";
        var routes = '';
        var utags = [];
        var atags = [];

        $(document).on('click', ".btn-submit-primary", function(e){
            e.preventDefault();
            this.closest('form').submit()
        });
    </script>

    <?php if(isset($user)): ?>
        <script>
            var routes = {
                data : '<?php echo e(route("rrhh.admin.candidates.applications.data",  $user)); ?>',
            };
             <?php $__currentLoopData = $userTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                utags.push('<?php echo e($ut); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $allTAgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                atags.push('<?php echo e($at); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>

    <?php echo e(Html::script('/js/textext.core.js')); ?>

    <?php echo e(Html::script('/js/textext.plugin.autocomplete.js')); ?>

    <?php echo e(Html::script('/js/textext.plugin.tags.js')); ?>

    <?php echo e(Html::script('/js/admin/users/candidatesform.js')); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>