@if(isset($menu))
	@php
		$menuReferences = [
			0 => 'menu travel trade',
			1 => 'menu media center',
			2 => 'menu corporate'
		];
	@endphp

	<ul class="nav navbar-nav menu-general">
		@foreach($menu as $index => $menuElement)

		@php
			$link = format_link($menuElement);
			$hasChildren = sizeof($menuElement["children"]) > 0 ? 1 : 0;
		@endphp

		<li class="dropdown mega-dropdown {{ Request::is($link['request_url'].'*') ? 'active' : '' }}">

			@if(isset($link))
					<a href="{{$link["url"]}}" id="{{$link["id"]}}" class="{{$hasChildren ? 'dropdown-toggle' : ''}} {{$link["class"]}}" @if($hasChildren)data-toggle="dropdown"@endif>{{$link["name"]}}</a>

					@if(sizeof($menuElement["children"]) > 0 )
						<ul class="dropdown-menu mega-dropdown-menu">
							<li  class="col-sm-8">
								<ul>
									@foreach($menuElement["children"] as $child)
										@php
											$childLink = format_link($child)
										@endphp
										@if(isset($childLink))
											<li class="col-sm-4">
												<a href="{{$childLink["url"]}}" id="{{$childLink["id"]}}" class="{{$childLink["class"]}}" {{isset($childLink["target"]) ? 'target=_blank' : ''}} >{{$childLink["name"]}}</a>
											</li>
										@endif
									@endforeach
								</ul>
							</li>
							@if(isset($menuReferences[$index]))
								<li class="col-sm-4 image">
									<!-- React MenuBanner -->
									<div id="menu_banner" name="{{$menuReferences[$index]}}">
									</div>

								</li>
							@endif
						</ul>
					@endif

			@endif
		</li>
		@endforeach
	</ul>
@endif
