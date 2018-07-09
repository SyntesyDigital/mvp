@extends('turisme::layouts.app')

@section('content')
<!-- ARTICLE -->
<article>

  @foreach($page as $node)
      @include('turisme::partials.node', [
          'node' => $node
      ])
  @endforeach

</article>
<!-- END ARTICLE -->
@endsection

@push('javascripts')
<script>
    $(function(){

    });
</script>
@endpush
