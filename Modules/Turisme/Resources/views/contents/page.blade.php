@extends('turisme::layouts.app')

@section('content')

    {!! breadcrumb($content) !!}

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
