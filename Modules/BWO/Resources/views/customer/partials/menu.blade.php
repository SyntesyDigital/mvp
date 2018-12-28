<ul class="candidate-menu">
	<li class="menu-item {{ $active_hex == 'profile'?'active':''}}">
		<a href="{{ route('customer.profile') }}" >Vos Informations</a>
	</li>
	<li class="menu-item {{ $active_hex == 'documents'?'active':''}}">
		<a href="" > Vos Documents</a>
	</li>
</ul>
