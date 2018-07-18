@extends('turisme::layouts.app')

@section('content')

    {!! breadcrumb(Modules\Architect\Entities\Content::find(4)) !!}

<!-- ARTICLE -->
<article>
    @if($page)
      @foreach($page as $node)
          @include('turisme::partials.node', [
              'node' => $node
          ])
      @endforeach
    @endif
</article>
<!-- END ARTICLE -->
@endsection

@push('javascripts')
<script>
    $(function(){

    });
</script>
@endpush
