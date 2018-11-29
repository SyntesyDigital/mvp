@extends('architect::layouts.master')

@section('content')
<div class="body">

    {!!
        Form::open([
            'url' => isset($offer)
                ? route('rrhh.admin.offers.update', $offer)
                : route('rrhh.admin.offers.store'),
            'method' => isset($offer) ? 'PUT' : 'POST',
            'id' => 'form-offer'
        ])
    !!}

    @if(isset($offer))
        <input type="hidden" name="_method" value="PUT" />
    @endif

    @foreach($form as $node)
        @include('rrhh::admin.offers.partials.node', [
            'node' => $node,
            'item' => isset($offer) ? $offer : null
        ])
    @endforeach

    {!! Form::close() !!}
</div>
@endsection


@push('javascripts-libs')
<script>
	var WEBROOT = "";
</script>

<!-- Vendors -->
{{ Html::script('/js/admin/content/contents/vendors/ckeditor/ckeditor.js') }}

<!-- CMS libs -->
{{ Html::script('/js/admin/content/contents/app.js') }}
{{ Html::script('/js/admin/content/contents/app.modal.js') }}
{{ Html::script('/js/admin/content/contents/app.editor.js') }}
@endpush

@push('javascripts')
{{ Html::script('/js/admin/offers/form.js')}}
{{ Html::script('/plugins/moment/moment-with-locales.js')}}

<script>
$('.datepicker-offer').datepicker({
     weekStart: 1,
     format: 'dd/mm/yyyy'
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

    function initMap() {

        var lat_init = {{ isset($offer) && $offer->latitude != null ? $offer->latitude: 48.858344}};
        var lat_lng = {{ isset($offer) && $offer->longitude != null ? $offer->longitude: 2.294331}};

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



        var csrf_token = "{{csrf_token()}}";
        var routes = {
            data : '{{ route("rrhh.admin.customers.data") }}',
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&language=fr&libraries=places">
</script>
@endpush
