@php echo '<?xml version="1.0" encoding="UTF-8"?>' @endphp
<source>
<publisher>Recrutement cadre dédié aux PME small IZ beautiful</publisher>
<publisherurl>http://www.menco.fr/</publisherurl>
<lastBuildDate>{{ date('D, d M	Y H:i:s O')}}</lastBuildDate>

	@foreach($offers as $o)
		<job>
			<title>{{ $o->title }}</title>

			 @if($o->start_at)
				@php
                $timestamp = strpos($o->start_at, '-')
                    ? strtotime($o->start_at)
                    : strtotime(Carbon\Carbon::createFromFormat('d/m/Y', $o->start_at));
                @endphp
				<date>{{ date('d M Y') }} </date>
            @endif
			<referencenumber>{{ $o->id }}</referencenumber>
			<url>{{ route('offer.show', [
                                    'job_1' => str_slug(Modules\RRHH\Entities\Tools\SiteList::getListValue($o->job_1, 'jobs1'), '-'),
                                    // 'job_2' => str_slug(Modules\RRHH\Entities\Tools\SiteList::getListValue($o->job_2, 'jobs2'), '-'),
                                    'id' => $o->id
                                ]) }}</url>
            @if($o->customer)
				<company>{{ $o->customer->name }}</company>
			@endif
			@if($o->address && $o->visibility == 1)
				<address>{{ $o->address or ''}}</address>
			@endif
				<description>{{ strip_tags($o->description) }}</description>
			@if($o->salary)
				<salary>{{ Modules\RRHH\Entities\Tools\SiteList::getListValue($o->salary, 'salaries') }}</salary>
			@endif
			@if($o->contract)
				<jobtype>{{ Modules\RRHH\Entities\Tools\SiteList::getListValue($o->contract, 'contracts') }}</jobtype>
			@endif
			@if($o->job_1)
				<category>{{ Modules\RRHH\Entities\Tools\SiteList::getListValue($o->job_1, 'jobs1') }}</category>
			@endif
		</job>
	@endforeach
</source>