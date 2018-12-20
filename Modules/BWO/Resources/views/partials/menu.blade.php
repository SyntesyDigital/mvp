@if(isset($menu))
	<ul class="nav navbar-nav mr-auto">
		@foreach($menu as $index => $menuElement)

		@php
			$link = format_link($menuElement);
			$hasChildren = sizeof($menuElement["children"]) > 0 ? 1 : 0;
		@endphp

		<li class="nav-item {{ Request::is($link['request_url'].'*') ? 'active' : '' }} {{sizeof($menuElement["children"]) > 0 ? 'dropdown' : ''}}">

			@if(isset($link))
					<a href="{{$link["url"]}}" id="{{$link["id"]}}" class="nav-link  {{$hasChildren ? 'dropdown-toggle' : ''}} {{$link["class"]}}" @if($hasChildren)data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"@endif>{{$link["name"]}}</a>

					@if(sizeof($menuElement["children"]) > 0 )
          <ul class="dropdown-menu">
            @foreach($menuElement["children"] as $child)
							@php
								$childLink = format_link($child)
							@endphp
							@if(isset($childLink))
								<li>
									<a href="{{$childLink["url"]}}" id="{{$childLink["id"]}}" class="{{$childLink["class"]}}" {{isset($childLink["target"]) ? 'target=_blank' : ''}} >{{$childLink["name"]}}</a>
								</li>
							@endif
						@endforeach

						</ul>
					@endif

			@endif
		</li>
		@endforeach
	</ul>
@endif
