<?php $__env->startSection('content'); ?>

    <?php echo Form::open([
            'url' => isset($user)
                ? route('rrhh.admin.candidates.update', $user)
                : route('rrhh.admin.candidates.store'),
            'method' => 'POST',
            'class' => 'check-inactive-candidate-form'
        ]); ?>


        <?php echo Form::hidden('id', isset($user) ? $user->id : null); ?>

        <?php echo Form::hidden('_method', isset($user) ? 'PUT' : 'POST'); ?>


        <?php echo Form::hidden('type', isset($user->candidate->type) && $user->candidate->type != '' ? $user->candidate->type : Modules\RRHH\Entities\Offers\Candidate::TYPE_NORMAL, [
                'id' => 'type',
            ]); ?>


        <?php echo Form::hidden('old_status', isset($user) && $user->status, [
                'id' => 'old_status',
            ]); ?>


        <?php echo Form::hidden('role_id', isset($role) ? $role->id : null , [
                'id' => 'role_id',
            ]); ?>


        <?php echo Form::hidden('tags_edit', '1' ); ?>

        <?php echo Form::hidden('docs_edit', '1' ); ?>


        <div class="page-bar">
          <div class="container">
            <div class="row">
              <div class="col-md-12">

                <a href="<?php echo e(route('rrhh.admin.candidates.index')); ?>" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>

                <h1>
                    <i class="fa fa-newspaper-o"></i>&nbsp;
                    <?php if(isset($user)): ?>
                        Edition du candidat <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?>

                    <?php else: ?>
                        Création d'un candidat
                    <?php endif; ?>
                </h1>

                <div class="float-buttons pull-right">

                  <?php if(isset($user)): ?>
                    <a href="#headingcandidatures" class="btn btn-default"> <i class="fa fa-address-card"></i> &nbsp;<?php echo e($user->candidate->applications->count()); ?> Candidatures </a>
                  <?php endif; ?>

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
                          <?php if(isset($user)): ?>
                          <li>
                              <a href="#" data-redirect="<?php echo e(route('rrhh.admin.candidates.index')); ?>" data-ajax="<?php echo e(route('rrhh.admin.candidates.delete', $user)); ?>" data-confirm-message="<?php echo e(Lang::get('architect::datatables.sure')); ?>" data-toogle="delete" class="text-danger">
                                  <i class="fa fa-trash text-danger"></i>
                                  &nbsp;
                                  <span class="text-danger"><?php echo e(Lang::get('architect::fields.delete')); ?></span>
                              </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </div>
                  <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="container rightbar-page candidate-page">

            <div class="col-md-9 page-content  field-group">

              


              <div id="headingtitle" class="btn btn-link" data-toggle="collapse" data-target="#collapsetitle" aria-expanded="true" aria-controls="collapsetitle">
                <span class="field-name">Informations du candidat</span>
              </div>

              <div id="collapsetitle" class="collapse in" aria-labelledby="headingtitle" aria-expanded="true" aria-controls="collapsetitle" style="">
                <div class="field-form">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group <?php echo e($errors->has("civility") ? 'has-error' : ''); ?>">
                              <label for="civility">Civilité</label>
                              <div class="radio">
                                  <label>
                                      <?php echo e(Form::radio('civility', Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE, [
                                              'checked' => isset($user) && $user->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE  ? 'checked': ''
                                          ])); ?>

                                      Monsieur
                                  </label>

                                  <label>
                                      <?php echo e(Form::radio('civility', Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE, [
                                              'checked' => isset($user) && $user->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE  ? 'checked': ''
                                          ])); ?>

                                      Madame
                                  </label>
                              </div>
                          </div>
                      </div>
                  </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has("firstname") ? 'has-error' : ''); ?>">
                                        <?php echo Form::label("firstname", 'Prénom'); ?>

                                        <?php echo Form::text('firstname', isset($user) ? $user->firstname : null, [
                                                'class' => 'form-control',
                                                'id' => 'firstname',
                                                'placeholder' => ''
                                            ]); ?>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has("lastname") ? 'has-error' : ''); ?>">
                                        <?php echo Form::label("lastname", 'Nom'); ?>

                                        <?php echo Form::text('lastname', isset($user) ? $user->lastname : null, [
                                                'class' => 'form-control',
                                                'id' => 'lastname',
                                                'placeholder' => ''
                                            ]); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
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
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php echo Form::label('birthplace', 'Lieu de naissance'); ?>

                                        <?php echo Form::text('birthplace', isset($user->candidate->birthplace) ? $user->candidate->birthplace:'', [
                                                'class' => 'form-control',
                                                'id' => 'birthplace'
                                            ]); ?>

                                    </div>
                                </div>
                            </div>


                            <div class="form-group <?php echo e($errors->has("email") ? 'has-error' : ''); ?>">
                                <?php echo Form::label('email', 'Email'); ?>

                                <?php echo Form::text('email', isset($user) ? $user->email : null, [
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'placeholder' => ''
                                    ]); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label('telephone', 'Telephone'); ?>

                                <?php echo Form::text('telephone', isset($user) ? $user->telephone : null, [
                                        'class' => 'form-control',
                                        'id' => 'password',
                                        'minlength' => '6',
                                        'placeholder' => ''
                                    ]); ?>

                            </div>

                            <div class="form-group">
                                <?php echo Form::label('password', 'Mot de passe'); ?>

                                <?php echo Form::password('password', [
                                        'class' => 'form-control',
                                        'id' => 'password',
                                        'minlength' => 6,
                                        'placeholder' => ''
                                    ]); ?>

                            </div>

                        </div>

                        <div class="col-md-6">
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

                                <?php echo Form::select(
                                        'country',
                                        config('rrhh.countries'),
                                        'France',
                                        [
                                            'class' => 'form-control input-round',
                                            'id' => 'country',
                                            'placeholder' => ''
                                        ]
                                    ); ?>

                            </div>
                        </div>
                    </div><!-- first block -->
                  </div>
              </div>

              <?php if(isset($user)): ?>
              <div id="headingmatricule" class="btn btn-link"  data-toggle="collapse" data-target="#collapsematricule" aria-expanded="true" aria-controls="collapsematricule">
                <span class="field-name">Convertir en intérimaire</span>
              </div>

              <div id="collapsematricule" class="collapse in" aria-labelledby="headingmatricule" aria-expanded="true" aria-controls="collapsematricule" style="">
                <div class="field-form">
                  <div class="form-group">
                      <label for="registration_number">Matricule</label>
                      <div class="row">
                          <div class="col-sm-6">
                              <?php if(isset($user)): ?>
                                  <?php echo e(Form::text('registration_number', isset($user) ? $user->candidate->registration_number : null, [
                                          'class' => 'form-control',
                                          'id' => 'registration_number'
                                      ])); ?>

                              <?php else: ?>
                                  <?php echo e(Form::hidden('registration_number', '')); ?>

                              <?php endif; ?>
                          </div>

                          <div class="col-sm-6">
                                  <?php if($user->candidate->type == Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM): ?>
                                       <p>Intérimaire depuis le <?php echo e($user->candidate->registered_at); ?></p>
                                  <?php else: ?>
                                      <input value="Convertir" type="button" class="btn btn-default convert_interimaire" />
                                  <?php endif; ?>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <div id="headingcomment" class="btn btn-link" data-toggle="collapse" data-target="#collapsecomment" aria-expanded="true" aria-controls="collapsecomment">
                <span class="field-name">Commentaire</span>
              </div>

              <div id="collapsecomment" class="collapse in" aria-labelledby="headingcomment" aria-expanded="true" aria-controls="collapsecomment" style="">
                  <div class="field-form">
                      <!-- Commentaire -->
                      <div class="form-group">
                          <?php echo Form::label('comment', 'Commentaire'); ?>

                          <?php echo Form::textarea('comment',  isset($user->candidate->comment) ? $user->candidate->comment:'', [
                                  'class' => 'form-control',
                                  'rows' => 4,
                                  'id' => 'comment'
                              ]); ?>

                      </div>
                  </div>
              </div>

              <?php if(isset($user)): ?>

              <div id="headingcandidatures" class="btn btn-link" data-toggle="collapse" data-target="#collapsecandidatures" aria-expanded="true" aria-controls="collapsecandidatures">
                <span class="field-name">Candidatures</span>
              </div>

              <div id="collapsecandidatures" class="collapse in" aria-labelledby="headingcandidatures" aria-expanded="true" aria-controls="collapsecandidatures" style="">
                  <div class="field-form">
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
                  </div>
              </div>
            <?php endif; ?>
          </div>

          <div class="sidebar">

              <!-- Status -->
              <div class="form-group">
                  <?php echo Form::label('status', 'Etat'); ?>

                  <?php echo Form::select('status',
                          [
                              App\Models\User::STATUS_ACTIVE => 'Actif',
                              App\Models\User::STATUS_INACTIVE => 'Inactif',
                          ],
                          isset($user) ? $user->status : null,
                          [
                              'class' => 'form-control',
                              'id' => 'status'
                          ]
                      ); ?>

              </div>

              <?php if(isset($user)): ?>

                  <hr/>

                  <h3 class="card-title">Tags</h3>

                  <?php echo Form::select(
                          'tags[]',
                          \Modules\RRHH\Entities\Tag::pluck('name', 'id'),
                          isset($user->candidate->tags) ? $user->candidate->tags->pluck('id') : old('tags'),
                          [
                              'class' => 'form-control toggle-select2',
                              'multiple' => 'multiple'
                          ]
                      ); ?>


                  <div class="separator" style="height:20px;"></div>

                  <!--

                  <?php echo Form::open([
                          'url' => route('rrhh.admin.candidates.updatetags', $user),
                          'method' => 'POST'
                          ]); ?>


                  <h3 class="card-title">Tags</h3>
                  <textarea type="text" name="tags" id="tags_fields" class="example" rows="1"></textarea>
                  <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />

                <?php echo Form::close(); ?>


                -->

              <?php endif; ?>


              <hr />

              <h3>Fichiers du candidat</h3>

              <!-- Fichier CV -->
              <div class="form-group file-form">
                  <label for="name">C.V.</label>

                  <?php if(isset($user) && $user->candidate->resume_file != ''): ?>
                    <div class="file-wrapper" id="filename-p_1">
                      <small class="filename-small" >

                          <a href="/storage/candidates/<?php echo e($user->candidate->resume_file); ?>" target="_blank">
                            <i class='fa fa-download'></i> &nbsp;
                            <?php echo e($user->candidate->resume_file); ?>

                          </a>

                          <a href="#" class="btn btn-link text-danger" onclick="deleteFile('1')">
                            <i class='fa fa-trash remove-file-click'></i> Supprimier
                          </a>
                      </small>
                    </div>
                  <?php else: ?>
                      <small class="filename-small" id="filename-p_1"></small>
                  <?php endif; ?>

                  <div class="medias-dropfiles medias-dropfiles_1 dz-div dz-div_1" style="<?php echo e(isset($user) && $user->candidate->resume_file != '' ? 'display:none' : null); ?>">
                      <p align="center">
                          <strong>Déposez vos fichiers</strong> <br />
                          <small>ou cliquez-ici</small>
                      <p>
                  </div>
                  <div class="progress dz-div dz-div_1" style="<?php echo e(isset($user) && $user->candidate->resume_file != '' ? 'display:none' : null); ?>">
                      <div class="progress-bar progress-bar_1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                          <span class="sr-only">70% Complete</span>
                      </div>
                  </div>

                  <?php echo Form::hidden('resume_file', isset($user) ? $user->candidate->resume_file : null, [
                          'id' => 'resume_file'
                      ]); ?>


              </div>

              <!-- Fichier Lettre de recommandation -->
              <div class="form-group file-form">
                  <label for="name">Lettre de recommandation</label>

                  <?php if(isset($user) && $user->candidate->recommendation_letter != ''): ?>
                    <div class="file-wrapper" id="filename-p_2">
                      <small class="filename-small" >

                          <a href="/storage/candidates/<?php echo e($user->candidate->recommendation_letter); ?>" target="_blank">
                            <i class='fa fa-download'></i> &nbsp;
                            <?php echo e($user->candidate->recommendation_letter); ?>


                          </a>
                          <a href="#" class="btn btn-link text-danger" onclick="deleteFile('2')">
                            <i class='fa fa-trash remove-file-click'></i> Supprimier
                          </a>
                      </small>
                    </div>
                  <?php else: ?>
                      <small class="filename-small" id="filename-p_2"></small>
                  <?php endif; ?>

                  <div class="medias-dropfiles medias-dropfiles_2 dz-div dz-div_2" style="<?php echo e(isset($user) && $user->candidate->recommendation_letter != '' ? 'display:none' : null); ?>">
                      <p align="center">
                          <strong>Déposez vos fichiers</strong> <br />
                          <small>ou cliquez-ici</small>
                      <p>
                  </div>

                  <div class="progress dz-div dz-div_2" style="<?php echo e(isset($user) && $user->candidate->recommendation_letter != '' ? 'display:none' : null); ?>">
                      <div class="progress-bar progress-bar_2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                          <span class="sr-only">70% Complete</span>
                      </div>
                  </div>

                  <?php echo Form::hidden('recommendation_letter', isset($user) ? $user->candidate->recommendation_letter : null, [
                          'id' => 'recommendation_letter'
                      ]); ?>


              </div>

        <?php echo Form::close(); ?>


        <div class="separator" style="height:50px;"></div>


        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
    <!-- Datatables -->
    <?php echo e(Html::style('/modules/rrhh/plugins/datatables/datatables.min.css')); ?>

    <?php echo e(Html::script('/modules/rrhh/plugins/datatables/datatables.min.js')); ?>

    <?php echo e(Html::script('/modules/rrhh/js/libs/dialog.js')); ?>


    <!-- Toastr -->
    <?php echo e(Html::style('/modules/rrhh/plugins/toastr/toastr.min.css')); ?>

    <?php echo e(Html::script('/modules/rrhh/plugins/toastr/toastr.min.js')); ?>


    <!-- Dropzone -->
    <?php echo e(Html::script('/modules/rrhh/plugins/dropzone/dropzone.js')); ?>


    <!-- Select2 -->
    <?php echo e(Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css')); ?>

    <?php echo e(Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js')); ?>


<?php $__env->stopPush(); ?>


<?php $__env->startPush('javascripts'); ?>

    <?php echo e(Html::script('/modules/rrhh/js/admin/users/candidatesform.js')); ?>



    <script>
        var routes = {
            data : '<?php echo e(isset($user) ? route("rrhh.admin.candidates.applications.data",  $user) : null); ?>',
            uploads : {
                resumeFile : '<?php echo e(route('rrhh.admin.candidates.filestore')); ?>',
                recommendationLetterFile : '<?php echo e(route('rrhh.admin.candidates.filestore')); ?>',
             }
        };

        var inactive_value = '<?php echo e(App\Models\User::STATUS_INACTIVE); ?>';
        var type_interim_value = '<?php echo e(Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM); ?>';
        var csrf_token = "<?php echo e(csrf_token()); ?>";
        var utags = [];
        var atags = [];

        $(document).ready(function() {

            $('.toggle-select2').select2();

            $(document).on('click', ".btn-submit-primary", function(e){
                e.preventDefault();
                this.closest('form').submit();
            });

            <?php if(isset($user)): ?>

                <?php $__currentLoopData = $userTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    utags.push('<?php echo e($ut); ?>');
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $allTAgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    atags.push('<?php echo e($at); ?>');
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            $(document).on('click','[data-toogle="delete"]',function(e){
                e.preventDefault();
                var el = $(e.target).closest('[data-toogle="delete"]');

                var ajax = el.data('ajax');
                var redirect = el.data('redirect');
                var confirmMessage = el.data('confirm-message');

                dialog.confirm(confirmMessage, function(result){
                    if(result) {

                        if(ajax) {
                            $.ajax({
                                method: 'DELETE',
                                url: ajax,
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                }
                            })
                            .done(function(response) {
                                if(response.success) {
                                    toastr.success(response.message, 'Succès !', {timeOut: 3000});

                                    if(redirect) {
                                        window.location = redirect;
                                        return;
                                    }

                                } else {
                                    toastr.error(response.message, 'Erreur !', {timeOut: 3000});
                                }
                            }).fail(function(response){
                                toastr.error(response.message, 'Erreur !', {timeOut: 3000});
                            });
                            return;
                        }
                    }
                });

            });

        });
    </script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>