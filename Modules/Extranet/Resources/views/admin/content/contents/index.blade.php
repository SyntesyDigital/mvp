@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">
                        @if($typology)
                            Liste contenu : {{strtolower($typology->name)}}
                        @endif

                        <a href="{{route('admin.content.create', $typology->identifier)}}" class="pull-right btn btn-primary">
                            Créer une page {{str_singular($typology->name)}}
                        </a>
                    </h3>
    				<h6 class="card-subtitle mb-2 text-muted">Tous les contenus</h6>

                    @if(isset($contents))
                    <table class="table" id="crosslinks-table">
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Créer le</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        @foreach($contents as $content)
                        <tr>
                            <td width="50">
                                {{ $content->id }}
                            </td>

                            <td>
                                <a href="{{ route('admin.content.show', $content) }}">
                                    {{ $content->getFieldValue('title') }}
                                </a>
                            </td>

                            <td>
                                {{ $content->user->full_name or '' }}
                            </td>

                            <td>
                                {{ $content->created_at->format('d/m/Y H:i:s') }}
                            </td>

                            <td>
                                @if($content->status == '0')
                                    Brouillon
                                @else
                                    Publié
                                @endif
                            </td>

                            <td class="text-right">
                                {!!
                                    Form::open([
                                        'url' => route('admin.content.delete', $content),
                                        'method' => 'POST',
                                        'class' => 'toggle-delete'
                                    ])
                                !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Supprimer" class="btn btn-sm btn-danger" />
                                    <a href="{{route('admin.content.show', $content)}}" class="btn btn-sm btn-success">Modifier</a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
