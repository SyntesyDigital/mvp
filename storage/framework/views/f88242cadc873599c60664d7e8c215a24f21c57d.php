<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo Form::open([
            'url' => isset($customer_contact)
                ? route('admin.customer_contacts.update', $customer_contact)
                : route('admin.customer_contacts.store'),
            'method' => 'POST',
            'class' => 'check-inactive-customer_contact-form'
        ]); ?>


        <input type="hidden" name="id" value="<?php echo e(isset($customer_contact->id) ? $customer_contact->id : ''); ?>" />
        <input type="hidden" name="_method" value="<?php echo e(isset($customer_contact) ? 'PUT' : 'POST'); ?>">

        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                  <?php if(isset($customer_contact)): ?>
                  <h2><a href="<?php echo e(route('admin.customers.show', $customer_contact->customer->id)); ?>"> <?php echo e($customer_contact->customer->name); ?></a></h2>
                  <?php endif; ?>
                    <h3 class="card-title"><?php echo e(isset($customer_contact) ? 'Edition du contact: '.$customer_contact->name :'Ajouter un contact'); ?></h3>


                    <div class="form-group">
                        <label for="title">Civilité</label>

                        <div class="radio" style="display: inline; margin-left:20px;">
                            <label style="font-size: .8em">
                                 <input type="radio"  name="title"  value="<?php echo e(App\Models\CustomerContact::TITLE_MALE); ?>" <?php echo e(isset($customer_contact) && $customer_contact->title == App\Models\CustomerContact::TITLE_MALE  ?'checked':''); ?>>Monsieur
                            </label>
                            <label style="font-size: .8em">
                                <input type="radio" name="title" value="<?php echo e(App\Models\CustomerContact::TITLE_FEMALE); ?>" <?php echo e(isset($customer_contact) && $customer_contact->title == App\Models\CustomerContact::TITLE_FEMALE  ?'checked':''); ?>>Madame
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Form::label('firstname', 'Prénom'); ?>

                        <?php echo Form::text('firstname', isset($customer_contact->firstname)? $customer_contact->firstname:'', [
                                'class' => 'form-control',
                                'id' => 'firstname'
                            ]); ?>

                    </div>


                    <div class="form-group">
                        <?php echo Form::label('lastname', 'Nom'); ?>

                        <?php echo Form::text('lastname', isset($customer_contact->lastname)? $customer_contact->lastname:'', [
                                'class' => 'form-control',
                                'id' => 'lastname'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('function', 'Fonction'); ?>

                        <?php echo Form::text('function', isset($customer_contact->function)? $customer_contact->function:'', [
                                'class' => 'form-control',
                                'id' => 'function'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('service', 'Service'); ?>

                        <?php echo Form::text('service', isset($customer_contact->service)? $customer_contact->service:'', [
                                'class' => 'form-control',
                                'id' => 'service'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('email', 'E-mail'); ?>

                        <?php echo Form::text('email', isset($customer_contact->email)? $customer_contact->email:'', [
                                'class' => 'form-control',
                                'id' => 'email'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('email_2', 'E-mail 2'); ?>

                        <?php echo Form::text('email_2', isset($customer_contact->email_2)? $customer_contact->email_2:'', [
                                'class' => 'form-control',
                                'id' => 'email_2'
                            ]); ?>

                    </div>



                    <div class="form-group">
                        <?php echo Form::label('phone_number_1', 'Téléphone'); ?>

                        <?php echo Form::text('phone_number_1', isset($customer_contact->phone_number_1)? $customer_contact->phone_number_1:'', [
                                'class' => 'form-control',
                                'id' => 'phone_number_1'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('phone_number_2', 'Téléphone 2'); ?>

                        <?php echo Form::text('phone_number_2', isset($customer_contact->phone_number_2)? $customer_contact->phone_number_2:'', [
                                'class' => 'form-control',
                                'id' => 'phone_number_2'
                            ]); ?>

                    </div>


                    <div class="form-group">
                        <?php echo Form::label('fax', 'Fax'); ?>

                        <?php echo Form::text('fax', isset($customer_contact->fax)? $customer_contact->fax:'', [
                                'class' => 'form-control',
                                'id' => 'fax'
                            ]); ?>

                    </div>

                    <?php echo Form::hidden('customer_id', $customer->id); ?>



                    <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />
                </div>
            </div>
        </div>

    <?php echo e(Form::close()); ?>


</div>
<?php if(isset($customer_contact)): ?>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <?php echo Form::open([
                    'url' => route('admin.customer_contacts.delete', $customer_contact->id),
                    'method' => 'POST',
                    'class' => 'delete-customer_contact-form'
                ]); ?>

            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Supprimer ce contact" class="btn btn-danger" />
            <?php echo e(Form::close()); ?>

        </div>
    </div>



<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts-libs'); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>

<?php $__env->stopPush(); ?>


<?php $__env->startPush('javascripts'); ?>

    <script>
    var csrf_token = "<?php echo e(csrf_token()); ?>";

    </script>

    <?php echo e(Html::script('/js/admin/customer_contacts/customer_contactsform.js')); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>