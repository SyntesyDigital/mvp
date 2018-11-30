<?php $__env->startSection('content'); ?>

<div class="row">
    <?php echo Form::open([
            'url' => isset($customer)
                ? route('admin.customers.update', $customer)
                : route('admin.customers.store'),
            'method' => 'POST',
            'class' => 'check-inactive-customer-form'
        ]); ?>


        <input type="hidden" name="id" value="<?php echo e(isset($customer->id) ? $customer->id : ''); ?>" />
        <input type="hidden" name="_method" value="<?php echo e(isset($customer) ? 'PUT' : 'POST'); ?>">

        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?php echo e(isset($customer) ? 'Edition du client : '.$customer->name : 'Ajouter un client'); ?></h3>

                    <div class="form-group">
                        <?php echo Form::label('name', 'Nom'); ?>

                        <?php echo Form::text('name', isset($customer->name)? $customer->name:'', [
                                'class' => 'form-control',
                                'id' => 'name'
                            ]); ?>

                    </div>


                    <div class="form-group">
                        <?php echo Form::label('contact_lastname', 'Contact Nom'); ?>

                        <?php echo Form::text('contact_lastname', isset($customer->contact_lastname)? $customer->contact_lastname:'', [
                                'class' => 'form-control',
                                'id' => 'contact_lastname'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('contact_firstname', 'Contact Prénom'); ?>

                        <?php echo Form::text('contact_firstname', isset($customer->contact_firstname)? $customer->contact_firstname:'', [
                                'class' => 'form-control',
                                'id' => 'contact_firstname'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('phone', 'Telephone'); ?>

                        <?php echo Form::text('phone', isset($customer->phone)? $customer->phone:'', [
                                'class' => 'form-control',
                                'id' => 'phone'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('email', 'E-mail'); ?>

                        <?php echo Form::text('email', isset($customer->email)? $customer->email:'', [
                                'class' => 'form-control',
                                'id' => 'email'
                            ]); ?>

                    </div>


                    <div class="form-group">
                        <?php echo Form::label('address', 'Adresse'); ?>

                        <?php echo Form::text('address', isset($customer->address)? $customer->address:'', [
                                'class' => 'form-control',
                                'id' => 'address'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('postal_code', 'Code Postal'); ?>

                        <?php echo Form::text('postal_code', isset($customer->postal_code) ?$customer->postal_code:'', [
                                'class' => 'form-control',
                                'id' => 'postal_code'
                            ]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('location', 'Localité'); ?>

                        <?php echo Form::text('location', isset($customer->location) ? $customer->location:'', [
                                'class' => 'form-control',
                                'id' => 'location'
                            ]); ?>

                    </div>

                    <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />
                </div>
            </div>
        </div>

    <?php echo e(Form::close()); ?>


</div>
<?php if(isset($customer)): ?>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <?php echo Form::open([
                    'url' => route('admin.customers.delete', $customer->id),
                    'method' => 'POST',
                    'class' => 'delete-customer-form'
                ]); ?>

            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Supprimer ce client" class="btn btn-danger" />
            <?php echo e(Form::close()); ?>

        </div>
    </div>


<div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                   <h3 class="card-title">Liste des contacts
                        <a href="<?php echo e(route('admin.customer_contacts.create', $customer->id )); ?>" class="pull-right btn btn-primary">
                            Ajouter un contact
                        </a>
                    </h3>
                    <h6 class="card-subtitle mb-2 text-muted">Tous les contacts</h6>

                    <table class="table" id="table-customer_contacts">
                        <thead>
                           <tr>
                               <th>#</th>
                               <th>Nom</th>
                               <th>Fonction</th>
                               <th>Email</th>
                               <th>Phone</th>
                               <th></th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                           </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
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


    <?php echo e(Html::script('js/libs/datatabletools.js')); ?>


     <?php if(isset($customer)): ?>
        <script>
            var routes = {
                data : '<?php echo e(route("rrhh.admin.customer_contacts.data", $customer->id)); ?>',
            };
        </script>
        <?php echo e(Html::script('/js/admin/customer_contacts/customer_contactslist.js')); ?>

    <?php endif; ?>


    <?php echo e(Html::script('/js/admin/customers/customersform.js')); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>