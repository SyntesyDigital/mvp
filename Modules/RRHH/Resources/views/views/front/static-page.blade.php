@extends('layouts.frontend', [
    'pageTitle' => $content ? $content->getFieldValue('title') : null,
    'htmlTitle' => $content ? $content->getFieldValue('meta_title') : null,
    'metaDescription' => $content ? $content->getFieldValue('meta_description') : null
])

@section('content')
<div class="blog-post">
	<div class="horizontal-inner-container">
		<div class="row">
			<div class="col-md-12">
				<div class="item">
					<div class="content">
						<p class="excerpt">
							{{ $content->getFieldValue('excerpt') }}
						</p>
                        @if($content->getFieldValue('summary_image'))    						
    						<div class="image left-align" style="background-image:url('{{ Storage::url('/medias/' . $content->getFieldValue('summary_image')) }}')">    							
    						</div>
                        @endif
						{!! $content->getFieldValue('content') !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
