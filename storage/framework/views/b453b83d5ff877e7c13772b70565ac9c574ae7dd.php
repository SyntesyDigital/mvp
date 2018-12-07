<?php $__env->startSection('content'); ?>

<?php echo Form::open([
        'url' => isset($offer)
            ? route('rrhh.admin.offers.update', $offer)
            : route('rrhh.admin.offers.store'),
        'method' => isset($offer) ? 'PUT' : 'POST',
        'id' => 'form-offer'
    ]); ?>


<?php echo e(Form::hidden('_method', isset($offer) ? 'PUT' : 'POST')); ?>


<div class="page-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="<?php echo e(route('rrhh.admin.offers.index')); ?>" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
        <h1><i class="fa fa-newspaper-o"></i>&nbsp;Offers</h1>
        <div class="float-buttons pull-right">

          <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
        </div>
      </div>
    </div>
  </div>
</div>


  <div class="container rightbar-page">

    <div class="col-md-9 page-content">
      <?php $__currentLoopData = config('offers.form.left'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $__env->make('rrhh::admin.offers.partials.node', [
              'node' => $node,
              'item' => isset($offer) ? $offer : null
          ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="sidebar">
      <?php $__currentLoopData = config('offers.form.right'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $__env->make('rrhh::admin.offers.partials.node', [
              'node' => $node,
              'item' => isset($offer) ? $offer : null
          ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

  </div>

<?php echo Form::close(); ?>



<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascripts-libs'); ?>

<!-- Datepicker -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/modules/turisme/plugins/datepicker/bootstrap-datetimepicker.min.css')); ?>">
<script src="<?php echo e(asset('/modules/turisme/plugins/datepicker/moment-with-locales.min.js')); ?>"></script>

<script src="<?php echo e(asset('/modules/turisme/plugins/datepicker/bootstrap-datetimepicker.min.js')); ?>"></script>

<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- Vendors -->
<?php echo e(Html::script('/js/admin/content/contents/vendors/ckeditor/ckeditor.js')); ?>


<!-- CMS libs -->
<?php echo e(Html::script('/js/admin/content/contents/app.js')); ?>

<?php echo e(Html::script('/js/admin/content/contents/app.modal.js')); ?>

<?php echo e(Html::script('/js/admin/content/contents/app.editor.js')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<?php echo e(Html::script('/js/admin/offers/form.js')); ?>


<script>
  $(document).ready(function() {

      $(document).on('click', ".btn-submit-primary", function(e){
          e.preventDefault();
          this.closest('form').submit()
      });


    $('#form-offer .datepicker-offer').datepicker({
         weekStart: 1,
         format: 'dd/mm/yyyy'
    });

  });
</script>

<script>
    var geocoder;
    var map;
    var marker;

    function ModifyUbicacion(){
        $('#latitude').val(marker.position.lat());
        $('#longitude').val(marker.position.lng());
    }

    $(document).ready(function() {
        geocoder = new google.maps.Geocoder();
        var input = /** @type  {HTMLInputElement} */(
            document.getElementById('address'));
        var autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            codeAddress();
        });

    });

    function initMap() {

        var lat_init = <?php echo e(isset($offer) && $offer->latitude != null ? $offer->latitude: 48.858344); ?>;
        var lat_lng = <?php echo e(isset($offer) && $offer->longitude != null ? $offer->longitude: 2.294331); ?>;

        var uluru = {lat: lat_init , lng: lat_lng };
        map = new google.maps.Map(document.getElementById('map-container'), {
          zoom: 9,
          center: uluru
        });
        marker = new google.maps.Marker({
          position: uluru,
          map: map,
          draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function(event) {
            ModifyUbicacion();
        });
        ModifyUbicacion();
    }

    function codeAddress() {
        var address = document.getElementById("address").value;
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                map.setZoom(9);
                ModifyUbicacion();
            }else{
                alert("Imposible to find");
            }
        });
    }


    $(document).ready(function() {



        var csrf_token = "<?php echo e(csrf_token()); ?>";
        var routes = {
            data : '<?php echo e(route("rrhh.admin.customers.data")); ?>',
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });

        $(document).on('change','.customers',function() {
           $( "select[name='customer_contact_id']" ).find('option').remove().end().append('<option value="">---</option>').val('');
            if(this.value != ''){
                $.ajax({
                    type: "POST",
                    url: "/admin/customer_contacts/list/" + this.value ,
                    data: {
                        },
                    success: function(data) {
                        $.each(data, function(index, value) {
                           $( "select[name='customer_contact_id']" ).append('<option value="'+value+'">'+index+'</option>');
                        });
                    },
                    error: function() {
                        toastr.danger('Error');
                    }
                });
            }

        });
    });


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GOOGLE_API_KEY')); ?>&callback=initMap&language=fr&libraries=places">
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('architect::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>