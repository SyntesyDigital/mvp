<?php $__env->startSection('content'); ?>

    <?php echo Form::open([
            'url' => isset($user) ? route('users.update', $user) : route('users.store'),
            'method' => 'POST',
        ]); ?>


    <?php if(isset($user)): ?>
        <?php echo Form::hidden('_method', 'PUT'); ?>

    <?php endif; ?>

    <div class="container rightbar-page content">


      

    <div class="container rightbar-page content">
        <div class="col-xs-6 col-xs-offset-3 page-content">

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($user)): ?>
                    <h1><?php echo e($user->full_name); ?></h1>
                    <?php else: ?>
                    <h1><?php echo e(Lang::get('architect::user.create')); ?></h1>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label><?php echo e(Lang::get('architect::fields.email')); ?></label>
                    <?php echo Form::text(
                            'email',
                            isset($user) ? $user->email : old('email'),
                            [
                                'class' => 'form-control'
                            ]
                        ); ?>

                </div>
            </div>

            <div class="row">


                <div class="col-md-6">
                    <label><?php echo e(Lang::get('architect::fields.firstname')); ?></label>
                    <?php echo Form::text(
                            'firstname',
                            isset($user) ? $user->firstname : old('firstname'),
                            [
                                'class' => 'form-control'
                            ]
                        ); ?>

                </div>

                <div class="col-md-6">
                    <label><?php echo e(Lang::get('architect::fields.lastname')); ?></label>
                    <?php echo Form::text(
                            'lastname',
                            isset($user) ? $user->lastname : old('lastname'),
                            [
                                'class' => 'form-control'
                            ]
                        ); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label><?php echo e(Lang::get('architect::fields.password')); ?></label>
                    <?php echo Form::password(
                            'password',
                            [
                                'class' => 'form-control'
                            ]
                        ); ?>

                </div>
                <div class="col-md-6">
                    <label><?php echo e(Lang::get('architect::fields.co_password')); ?></label>
                    <?php echo Form::password(
                            'password_confirmation',
                            [
                                'class' => 'form-control'
                            ]
                        ); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <?php
                      $languages = [
                                    'ca' => Lang::get('architect::user.catalan'),
                                    'es' => Lang::get('architect::user.spanish'),
                                    'en' => Lang::get('architect::user.english'),
                                    'fr' => Lang::get('architect::user.french')
                                   ];
                     $userLang = isset($user) && $user->language != '' ? $user->language : old('language');

                    ?>

                    <label><?php echo e(Lang::get('architect::fields.language')); ?></label>
                    <?php echo Form::select(
                            'language',
                            $languages,
                            $userLang,
                            [
                                'class' => 'form-control',
                                'placeholder'=> '---'
                            ]
                        ); ?>

                </div>
            </div>


            <?php if(Auth::user()->hasRole(["admin"])): ?>

              <div class="row">
                  <div class="col-md-12">

                      <?php
                        $userRole = isset($user) && $user->roles && $user->roles->count() > 0 ? $user->roles->first()->id : old('role');
                      ?>

                      <label><?php echo e(Lang::get('architect::fields.role')); ?></label>
                      <?php echo Form::select(
                              'role_id',
                              App\Models\Role::pluck('display_name', 'id'),
                              $userRole,
                              [
                                  'class' => 'form-control',
                                  'placeholder'=> '---'
                              ]
                          ); ?>

                  </div>
              </div>

            <?php else: ?>

              <input type="hidden" name="role_id" value="<?php echo e(isset($user) && $user->roles && $user->roles->count() > 0 ? $user->roles->first()->id : old('role')); ?>" />

            <?php endif; ?>


            <div class="row">
                <div class="col-md-12 text-right">
                    <?php echo Form::submit(Lang::get('architect::fields.save'), [
                            'class' => 'btn btn-primary'
                        ]); ?>

                </div>
            </div>




    </div>

      <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts-libs'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>