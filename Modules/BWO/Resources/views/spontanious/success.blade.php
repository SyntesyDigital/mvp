@extends('layouts.frontend',[
    'header' => 'white-bar',
	'search_bar_style' => 'display:none',
	'headerTitle' => 'Candidature spontanée',
	'htmlTitle' => 'Candidature spontanée'
 ])

@section('content')
<div class="spontanious">
	<div class="bk-candidate-menu" style="background-image:url('{{asset('images/candidate-bk-hexagons.jpg')}}')">
		<div class="horizontal-inner-container horizontal-inner-container-candidate-profile" >
			<div class="candidate-page-content" style="min-height: 400px;">
				<h2>Votre candidature a été enregistrée !</h2>
                <br /><br />
                @if(Auth::check())
                	<p align="center">
	                    Merci de nous avoir adressé votre candidature.
	                </p>
                @else
	                <p align="center">
	                    Merci de nous avoir adressé votre candidature, <br />
	                    Vous recevrez un e-mail contenant vos identifiants <br />
	                    pour vous connecter à notre espace candidat.
	                </p>
	            @endif
                <br /><br />

                <p align="center">
                    <a href="/" class="btn">OK</a>
                </p>
			</div>
		</div>
	</div>

	<div class="offers-separator"></div>
</div>
@endsection

@push('stylesheets')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endpush

@push('javascripts-libs')
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
@endpush

@push('javascripts')
	<script>
		$(function() {
            $( "input[name='birthday']" ).datepicker({ dateFormat: "dd/mm/yy" });
		});
	</script>
@endpush
