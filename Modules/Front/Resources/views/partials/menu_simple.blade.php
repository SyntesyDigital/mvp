@if(isset($menu))

		@foreach($menu as $index => $menuElement)

		@php
			$link = format_link($menuElement);
			$hasChildren = sizeof($menuElement["children"]) > 0 ? 1 : 0;
		@endphp


			@if(isset($link))

				&nbsp;	- &nbsp;

					<a href="{{$link["url"]}}" id="{{$link["id"]}}" class="nav-link  {{$hasChildren ? 'dropdown-toggle' : ''}} {{$link["class"]}}" @if($hasChildren)data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"@endif>{{$link["name"]}}</a>
			@endif

		@endforeach

@endif
