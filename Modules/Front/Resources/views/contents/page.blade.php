@php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($contentSettings) && isset($contentSettings['pageType']) ? $contentSettings['pageType'] : '';
  $idClass = isset($content) ? "id_".$content->id : '';
@endphp

@extends('front::layouts.app',[
  'title' => isset($content) ? $content->getFieldValue('title') : '',
  'mainClass' => $pageType.' '.$htmlClass.' '.$idClass,
  'routeAttributes' => $content->getFullSlug()
])

@section('content')

@if(isset($content) && $content->parent_id != null)
<div class="single">
  <div class="breadcrumb">
   <div class="container">
     <div class="row">
          {!! breadcrumb($content) !!}
		 </div>
   </div>
  </div>
</div>
@endif



<!-- ARTICLE -->
<article class="page-builder">
    <h2>{{$content->title}}</h2>

    <div class="element-form-container container row justify-content-center">
      <form>
        <div class="col-md-offset-1 col-md-8">
          <div class="row element-form-row">
            <div class="col-sm-4">
              <label>Référence courtier</label>
            </div>
            <div class="col-sm-8">
              <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
            </div>
          </div>
          <div class="row element-form-row">
            <div class="col-sm-4">
              <label>Date de survenance <span>*</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
            </div>
          </div>
          <div class="row element-form-row">
            <div class="col-sm-4">
              <label>Responsabilité <span>*</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
            </div>
          </div>
          <div class="row element-form-row">
            <div class="col-sm-4">
              <label>Référence courtier</label>
            </div>
            <div class="col-xs-8">
              <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
            </div>
          </div>
          <div class="row element-form-row">
            <div class="col-sm-4">
              <label>Référence courtier</label>
            </div>
            <div class="col-sm-8">
              <textarea type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"></textarea>
            </div>
          </div>

          <div class="row element-form-row">
            <div class="col-md-4"></div>
            <div class="col-md-8 buttons">
                <button class="btn btn-primary right" type="submit"><i class="fa fa-paper-plane"></i>Valider</button>
                <a class="btn btn-back left"><i class="fa fa-angle-left"></i> Retour</a>
            </div>
          </div>
        </div>
      </form>
    </div>



    <div class="element-file-container">
      <div class="element-file-container-head">
        FICHE SINISTRE
      </div>
      <div class="element-file-container-body">
          <div class="row">
            <div class="col-md-6">
              <div class="element-file-input-container">
                <div class="col-xs-6 element-file-title">
                  Référence courtier
                </div>
                <div class="col-xs-6 element-file-content">
                  Référence courtier
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="element-file-input-container">
                <div class="col-xs-6 element-file-title">
                  Référence courtier
                </div>
                <div class="col-xs-6 element-file-content">
                  Référence courtier
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="element-file-input-container">
                <div class="col-xs-6 element-file-title">
                  Référence assureur
                </div>
                <div class="col-xs-6 element-file-content">
                  Référence assureur
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="element-file-input-container">
                <div class="col-xs-6 element-file-title">
                  Référence assureur
                </div>
                <div class="col-xs-6 element-file-content">
                  Référence assureur
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="element-file-input-container">
                <div class="col-xs-6 element-file-title">
                  Date de survenance
                </div>
                <div class="col-xs-6 element-file-content">
                  14/10/2018
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="element-file-input-container">
                <div class="col-xs-6 element-file-title">
                  Date de survenance
                </div>
                <div class="col-xs-6 element-file-content">
                  14/10/2018
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>



    @if($page)
      @foreach($page as $node)
          @include('front::partials.node', [
              'node' => $node
          ])
      @endforeach
    @endif
</article>
<!-- END ARTICLE -->
@endsection

@push('javascripts')
<script>
    routes = {"categoryNews" : "{{route('blog.category.index' ,['slug' => ':slug'])}}",
              "tagNews"      : "{{route('blog.tag.index' ,['slug' => ':slug'])}}" };
    $(function(){

    });
</script>
@endpush
