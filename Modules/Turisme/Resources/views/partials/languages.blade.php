<ul>

	@php
		$supportedLocales = LaravelLocalization::getSupportedLocales();
		$routeAttributes = !isset($error500) && isset($routeAttributes) ? $routeAttributes : [];
		$routeName = isset($error500) ? 'home' : Request::route()->getName();
	@endphp

	@foreach($supportedLocales as $localeCode => $properties)
		<li @if(App::getLocale() == $localeCode) class="current" @endif>

			<!-- FIXME change this getURL from URLS by locale -->
			<a
					rel="alternate"
					hreflang="{{ $localeCode }}"
					href="{{ LaravelLocalization::getURLFromRouteNameTranslated($localeCode,"routes.".$routeName,$routeAttributes) }}">
          {{ $properties['native'] }}
      </a>

		</li>
	@endforeach

</ul>
