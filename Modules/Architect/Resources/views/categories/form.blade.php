@extends('architect::layouts.master')

@section('content')

    {!!
        Form::open([
            'url' => isset($category) ? route('categories.update', $category) : route('categories.store'),
            'method' => 'POST',
        ])
    !!}

    <div class="container rightbar-page content">


      <div class="page-bar">
        <div class="container">
          <div class="row">

            <div class="col-md-12">
              <a href="{{route('categories')}}" class="btn btn-default btn-close"> <i class="fa fa-angle-left"></i> </a>
              <h1>
                <i class="fa fa-list "></i>
                @if(isset($category))
                  Edita categoria {{$category->name or ''}}
                @else
                  Nova categoria
                @endif
              </h1>

              <div class="float-buttons pull-right">

              <div class="actions-dropdown">
                <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
                  Accions
                  <b class="caret"></b>
                  <div class="ripple-container"></div>
                </a>
                  <ul class="dropdown-menu dropdown-menu-right default-padding">
                      <li class="dropdown-header"></li>
                      <li>
                          <a href="{{route('categories.create')}}">
                              <i class="fa fa-plus-circle"></i>
                              &nbsp;Nou
                          </a>
                      </li>
                      <li>
                          <a href="{{route('account')}}" class="text-danger">
                              <i class="fa fa-trash text-danger"></i>
                              &nbsp;
                              <span class="text-danger">Esborrar</span>
                          </a>
                      </li>
                  </ul>
                </div>


                {!!
                    Form::submit('Guardar', [
                        'class' => 'btn btn-primary'
                    ])
                !!}

                <!--
                <a href="" class="btn btn-primary" > <i class="fa fa-cloud-upload"></i> &nbsp; Guardar </a>
                -->
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="container rightbar-page content">

        <div class="col-xs-8 col-xs-offset-2 page-content">
          <div class="field-group">

              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif

              @if (session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
                  </div>
              @endif

              @if(isset($category))
                  {!! Form::hidden('_method', 'PUT') !!}
              @endif

              <div class="field-group">

                  @foreach(Modules\Architect\Entities\Category::FIELDS as $field)
                      @switch($field["type"])
                          @case('text')
                              <div class="field-item">
                                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                                      <span class="field-type">
                                          <i class="fa fa-font"></i> {{ ucfirst($field['type']) }}
                                      </span>
                                      <span class="field-name">
                                          {{ $field['name'] }}
                                      </span>
                                  </div>

                                  <div id="collapse{{ $field['identifier'] }}" class="collapse in" aria-labelledby="heading{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                                      <div class="field-form">
                                          @foreach(Modules\Architect\Entities\Language::all() as $language)
                                              <div class='form-group bmd-form-group'>
                                                  <label class="bmd-label-floating">{{ $field['name'] }} - {{ $language->name }}</label>
                                                  @php
                                                      $fieldName = "fields[" . $field['name'] . "][" . $language->id . "]";
                                                  @endphp
                                                  {!!
                                                      Form::text(
                                                          $fieldName,
                                                          isset($category) ? $category->getFieldValue($field['identifier'], $language->id) : old($fieldName),
                                                          [
                                                              'class' => 'form-control'
                                                          ]
                                                      )
                                                  !!}
                                              </div>
                                          @endforeach()
                                      </div>
                                  </div>
                              </div>
                          @break

                          @case('richtext')
                              <div class="field-item">
                                  <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                                      <span class="field-type">
                                          <i class="fa fa-font"></i> {{ ucfirst($field['type']) }}
                                      </span>
                                      <span class="field-name">
                                          {{ $field['name'] }}
                                      </span>
                                  </div>

                                  <div id="collapse{{ $field['identifier'] }}" class="collapse in" aria-labelledby="heading{{ $field['identifier'] }}" aria-expanded="true" aria-controls="collapse{{ $field['identifier'] }}">
                                      <div class="field-form">
                                          @foreach(Modules\Architect\Entities\Language::all() as $language)
                                              <div class='form-group bmd-form-group'>
                                                  <label class="bmd-label-floating">{{ $field['name'] }} - {{ $language->name }}</label>
                                                  @php
                                                      $fieldName = "fields[" . $field['name'] . "][" . $language->id . "]";
                                                  @endphp
                                                  {!!
                                                      Form::textarea(
                                                          $fieldName,
                                                          isset($category) ? $category->getFieldValue($field['identifier'], $language->id) : old($fieldName),
                                                          [
                                                              'class' => 'form-control'
                                                          ]
                                                      )
                                                  !!}
                                              </div>
                                          @endforeach()
                                      </div>
                                  </div>
                              </div>
                          @break

                      @endswitch
                  @endforeach()

                  <div class="field-item">
                      <div id="heading" class="btn btn-link" data-toggle="collapse" data-target="#collapse_parent_id" aria-expanded="true" aria-controls="collapse_parent_id">
                          <span class="field-type">
                              <i class="fa fa-font"></i> Categoria
                          </span>
                          <span class="field-name">
                              Categoria pare
                          </span>
                      </div>

                      <div id="collapse_parent_id" class="collapse in" aria-labelledby="heading-collapse" aria-expanded="true" aria-controls="collapse-collapse">
                          <div class="field-form">
                              @php
                                  $categories = Modules\Architect\Entities\Category::all()->pluck('name', 'id');
                                  if(isset($category)) {
                                      $categories->forget($category->id);
                                  }

                              @endphp

                              {!!
                                  Form::select(
                                      'parent_id',
                                      ['' =>'---'] + $categories->toArray(),
                                      isset($category) ? $category->parent_id : null,
                                      [
                                          'class' => 'form-control'
                                      ]
                                  )
                              !!}
                          </div>
                      </div>
                  </div>

                  <br/>
                  <br/>
                  <br/>
                  <br/>

                </div>

              </div>
            </div>

          </div>

      </div>

      {!! Form::close() !!}

@stop

@push('javascripts-libs')

@endpush
