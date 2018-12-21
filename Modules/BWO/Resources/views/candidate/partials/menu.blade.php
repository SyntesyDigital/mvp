<ul class="candidate-menu">
	<li class="menu-item {{ $active_hex == 'profile'?'active':''}}">
		<a href="{{ route('candidate.profile') }}" >Informations</a>
	</li>
	<li class="menu-item {{ $active_hex == 'application'?'active':''}}">
		<a href="{{ route('candidate.application') }}" >
			Candidatures
		</a>
	</li>
	<li class="menu-item {{ $active_hex == 'alert'?'active':''}}">
		<a href="{{ route('candidate.alert') }}" >Alertes</a>
	</li>
	<li class="menu-item {{ $active_hex == 'documents'?'active':''}}">
		<a href="{{ route('candidate.document') }}" >Documents</a>
	</li>
	<li class="menu-item {{ $active_hex == 'contact'?'active':''}}">
		<a href="{{ route('candidate.contact') }}" >Contactez-nous</a>
	</li>
</ul>
