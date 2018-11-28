<div class="candidate-menu">

	<div class="row {{ $active_hex == 'application'?'active':''}}">
		<a href="{{ route('candidate.application') }}" ><div class="menu-title" >Vos candidatures</div></a>
	</div>
	<div class="row {{ $active_hex == 'profile'?'active':''}}">
		<a href="{{ route('candidate.profile') }}" ><div class="menu-title" >Vos informations</div></a>
	</div>
	<div class="row {{ $active_hex == 'alert'?'active':''}}">
		<a href="{{ route('candidate.alert') }}" ><div class="menu-title" >Vos alertes</div></a>
	</div>
	<div class="row {{ $active_hex == 'contact'?'active':''}}">
		<a href="{{ route('candidate.contact') }}" ><div class="menu-title" >Contactez-nous</div></a>
	</div>
</div>
