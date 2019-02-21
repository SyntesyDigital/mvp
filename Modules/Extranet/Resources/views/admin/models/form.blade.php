@extends('architect::layouts.master')

@section('content')

{!!
    Form::open([
        'url' => isset($offer)
            ? route('extranet.admin.offers.update', $offer)
            : route('extranet.admin.offers.store'),
        'method' => isset($offer) ? 'PUT' : 'POST',
        'id' => 'form-offer'
    ])
!!}

{{ Form::hidden('_method', isset($offer) ? 'PUT' : 'POST') }}

<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('extranet.admin.offers.index')}}" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
                <h1><i class="fa fa-newspaper-o"></i>&nbsp;Offers</h1>
                <div class="float-buttons pull-right">

                    @if(isset($offer))
                      <a href="{{route('extranet.admin.offer.applications.show', $offer)}}" class="btn btn-default"> <i class="fa fa-address-card"></i> &nbsp;{{$offer->applications()->count()}}  Candidatures </a>
                      <a href="{{route('offers.preview', $offer)}}" class="btn btn-default" target="_blank"> <i class="fa fa-eye"></i> &nbsp; Prévisualisation </a>
                        @if(env('FACEBOOK_APP_ID'))
                            <a href="{{route('extranet.admin.offer.applications.publish.facebook', $offer)}}" class="btn btn-default"> <i class="fa fa-cloud-upload"></i> &nbsp; Publier sur facebook </a>
                        @endif
                    @endif

                    <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container rightbar-page">
    <div class="col-md-9 page-content">
        @foreach(config('offers.form.left') as $node)
            @include('extranet::admin.offers.partials.node', [
              'node' => $node,
              'item' => isset($offer) ? $offer : null
            ])
        @endforeach
    </div>
    <div class="sidebar">
        @foreach(config('offers.form.right') as $node)
            @include('extranet::admin.offers.partials.node', [
              'node' => $node,
              'item' => isset($offer) ? $offer : null
            ])
        @endforeach
    </div>
</div>

{!! Form::close() !!}

@endsection


@push('javascripts-libs')
<!-- Datepicker -->
{{ Html::style('/modules/extranet/plugins/datepicker/bootstrap-datetimepicker.min.css') }}
{{ Html::script('/modules/extranet/plugins/datepicker/moment-with-locales.min.js') }}
{{ Html::script('/modules/extranet/plugins/datepicker/bootstrap-datetimepicker.min.js') }}

<!-- Select2 -->
{{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css') }}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js') }}

<!-- Vendors -->
{{ Html::script('/modules/extranet/plugins/ckeditor/ckeditor.js') }}
@endpush


@push('javascripts')
{{ Html::script('/modules/extranet/js/admin/offers/form.js')}}

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
        var input = /** @type {HTMLInputElement} */(
            document.getElementById('address'));
        var autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            codeAddress();
        });

    });

    function initMap()
    {
        var location = {
            lat: {{ isset($offer) && $offer->latitude != null ? $offer->latitude: 48.858344}},
            lng: {{ isset($offer) && $offer->longitude != null ? $offer->longitude: 2.294331}}
        };

        map = new google.maps.Map(document.getElementById('map-container'), {
          zoom: 9,
          center: location
        });

        marker = new google.maps.Marker({
          position: location,
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

        var csrf_token = "{{csrf_token()}}";
        var routes = {
            data : '{{ route("extranet.admin.customers.data") }}',
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });

        // Set customer contact
        $('.customers').on('change',function() {

            $("select[name='customer_contact_id']")
                .find('option')
                .remove()
                .end()
                .append('<option value="">---</option>')
                .val('');

            if(this.value != ''){
                $.ajax({
                    type: "POST",
                    url: "/admin/customer_contacts/list/" + this.value,
                    data: {},
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&language=fr&libraries=places"></script>
@endpush
