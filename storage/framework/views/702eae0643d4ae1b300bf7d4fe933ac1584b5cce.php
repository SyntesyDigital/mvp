
<?php if($node['type'] == "row"): ?>
    <div class="row">
<?php endif; ?>


<?php if($node['type'] == "col"): ?>
    <div class="<?php echo e($node['class']); ?>">
<?php endif; ?>


<?php if($node['type'] == "box"): ?>
    <!--div class="card">
        <div class="card-body"-->
            <h3 class="card-title"><?php echo e(isset($node['title']) ? $node['title'] : ''); ?></h3>
            <?php if(isset($node['subtitle'])): ?>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo e(isset($node['subtitle']) ? $node['subtitle'] : ''); ?></h6>
            <?php endif; ?>
<?php endif; ?>


<?php if($node['type'] == "hr"): ?>
    <hr />
<?php endif; ?>


<?php if($node['type'] == "br"): ?>
    <div class="separator"></div><br />
<?php endif; ?>

<?php if($node['type'] == "map"): ?>
     <div class="form-group">
        <div class="location-box">
            <label><?php echo e($node["label"]); ?></label>
            <div id="<?php echo e(isset($node["id"]) ? $node["id"] : ''); ?>" class="map-container">
            </div>
        </div>
     </div>
<?php endif; ?>


<?php if($node['type'] == "field"): ?>
    <?php if($node["input"] == 'text'): ?>
        <div class="form-group bmd-form-group  <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label class="bmd-label-floating"><?php echo e($node["label"]); ?></label>
            <input type="text" class="form-control" id="<?php echo e(isset($node["id"]) ? $node["id"] : ''); ?>" name="<?php echo e($node["name"]); ?>" placeholder="<?php echo e(isset($node["placeholder"]) ? $node["placeholder"] : ''); ?>" value="<?php echo e(isset($item) ? $item->{$node["name"]} : old($node["name"])); ?>">
        </div>
    <?php endif; ?>

    <?php if($node["input"] == 'hidden'): ?>
        <input
            type="hidden"
            class="form-control"
            id="<?php echo e(isset($node["id"]) ? $node["id"] : ''); ?>"
            name="<?php echo e($node["name"]); ?>"
            placeholder="<?php echo e(isset($node["placeholder"]) ? $node["placeholder"] : ''); ?>"
            value="<?php echo e(isset($item) ? $item->{$node["name"]} : old($node["name"])); ?>"
        >
    <?php endif; ?>


    <?php if($node["input"] == 'date'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label><?php echo e($node["label"]); ?></label>

            <?php
                $date = isset($item) ? $item->{$node["name"]} : null;
                $date = str_contains($date, '/') !== false ? Carbon\Carbon::createFromFormat('d/m/Y', $item->{$node["name"]})->timestamp : $date;
            ?>

            <input
                id="<?php echo e(isset($node["id"]) ? $node["id"] : rand()); ?>"
                type="text"
                autocomplete="off"
                class="form-control datepicker-offer"
                name="<?php echo e($node["name"]); ?>"
                placeholder="<?php echo e(isset($node["placeholder"]) ? $node["placeholder"] : ''); ?>"
                value="<?php echo e($date ? date('d/m/Y', $date) : old($node["name"])); ?>"
            >
        </div>
    <?php endif; ?>

    <?php if($node["input"] == 'textarea'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label><?php echo e($node["label"]); ?></label>
            <textarea class="form-control" id="<?php echo e(isset($node["id"]) ? $node["id"] : ''); ?>" rows="6" name="<?php echo e($node["name"]); ?>" placeholder="<?php echo e(isset($node["placeholder"]) ? $node["placeholder"] : ''); ?>"><?php echo e(isset($item) ? $item->{$node["name"]} : old($node["name"])); ?></textarea>
        </div>
    <?php endif; ?>

    <?php if($node["input"] == 'richtext'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label><?php echo e($node["label"]); ?></label>
            <textarea
                id="<?php echo e($node["name"]); ?>_editor"
                class="form-control"
                name="<?php echo e($node["name"]); ?>"
                rows="6" p
                laceholder="<?php echo e(isset($node["placeholder"]) ? $node["placeholder"] : ''); ?>"
            >
            <?php echo e(isset($item) ? $item->{$node["name"]} : old($node["name"])); ?>

            </textarea>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                CKEDITOR.replace('<?php echo e($node["name"]); ?>_editor', {
                    height: '300px',
                    toolbarGroups :  [
                        {"name":"basicstyles","groups":["basicstyles"]},
                        {"name":"links","groups":["links"]},
                        {"name":"paragraph","groups":["list","blocks"]},
                        {"name":"document","groups":["mode"]},
                        {"name":"styles","groups":["styles"]},
                        {"name":"architect","groups":["architect"]},
                    ],
                    removeButtons : 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
                    allowedContent: true
                });
            });
        </script>
    <?php endif; ?>

    <?php if($node["input"] == 'checkbox'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label>
                <input
                    id="<?php echo e(isset($node["id"]) ? $node["id"] : ''); ?>"
                    type="checkbox"
                    name="<?php echo e($node["name"]); ?>"
                    value="<?php echo e(isset($node["value"]) ? $node["value"] : old($node["name"])); ?>" <?php if($item && $item->{$node["name"]}): ?> checked <?php endif; ?>
                >
                <?php echo e($node["label"]); ?>

            </label>
        </div>
    <?php endif; ?>

    <?php if($node["input"] == 'tags'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <?php echo Form::select(
                    $node["name"],
                    \Modules\RRHH\Entities\Tag::pluck('name', 'id'),
                    isset($item) ? $item->{str_replace('[]', '', $node["name"])} : old($node["name"]),
                    [
                        'class' => 'form-control toggle-select2',
                        'multiple' => 'multiple'
                    ]
                ); ?>

            <script>
                $(document).ready(function() {
                    $('.toggle-select2').select2();
                });
            </script>
        </div>
    <?php endif; ?>

    <?php if($node["input"] == 'list'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label><?php echo e($node["label"]); ?></label>
            <?php
                $default = isset($node["default"]) ? $node["default"] : null;
            ?>

            <?php echo Form::siteList(
                    $node["identifier"],
                    $node["name"],
                    isset($item) ? $item->{$node["name"]} : $default,
                    [
                        'class' => 'form-control',
                        'placeholder' => isset($node["placeholder"]) ? $node["placeholder"] : '-'
                    ]
                ); ?>

        </div>
    <?php endif; ?>

    <?php if($node["input"] == 'users'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label><?php echo e($node["label"]); ?></label>
            <?php echo Form::users(
                    $node["roles"],
                    $node["name"],
                    isset($item) ? $item->{$node["name"]} : old($node["name"]),
                    [
                        'class' => 'form-control',
                        'placeholder' => isset($node["placeholder"]) ? $node["placeholder"] : null,
                    ]
                ); ?>

        </div>
    <?php endif; ?>


     <?php if($node["input"] == 'customers'): ?>
        <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            <label><?php echo e($node["label"]); ?></label>
            <?php echo Form::customers(
                    $node["name"],
                    isset($item) ? $item->{$node["name"]} : old($node["name"]),
                    [
                        'class' => 'form-control customers',
                        'placeholder' => isset($node["placeholder"]) ? $node["placeholder"] : null,
                    ]
                ); ?>

        </div>
    <?php endif; ?>


    <?php if($node["input"] == 'customers_contacts'): ?>

         <div class="form-group <?php echo e($errors->has($node["name"]) ? 'has-error' : ''); ?>">
            

        </div>
    <?php endif; ?>


    <?php if($node["input"] == 'submit'): ?>
        <input value="Enregistrer" type="submit" class="btn <?php echo e(isset($node["class"]) ? $node["class"] : ''); ?>" />
    <?php endif; ?>
<?php endif; ?>


<?php if(isset($node['childs'])): ?>
    <?php $__currentLoopData = $node['childs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('rrhh::admin.offers.partials.node', [
            'node' => $n,
            'item' => isset($item) ? $item : null
        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php if($node['type'] == "box"): ?>
        <!--/div>
    </div-->
<?php endif; ?>


<?php if($node['type'] == "row" || $node['type'] == "col"): ?>
    </div>
<?php endif; ?>
