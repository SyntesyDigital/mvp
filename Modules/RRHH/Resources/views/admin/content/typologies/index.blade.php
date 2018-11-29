@extends('architect::layouts.master')

@section('content')
<div class="body">
    @if(isset($typologies))
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des tipologies
                        <a href="{{route('admin.content.typologies.create')}}" class="pull-right btn btn-primary">
                            Créer une typologie
                        </a>
                    </h3>
    				<h6 class="card-subtitle mb-2 text-muted">Une tipologie est un type de contenu</h6>

                    <table class="table" id="crosslinks-table">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Identifiant</th>
                            <th></th>
                        </tr>
                        @foreach($typologies as $t)
                        <tr>
                            <td width="50">
                                {{ $t->id }}
                            </td>

                            <td>
                                <a href="{{ route('admin.content.typologies.show', $t->id) }}">
                                    {{ $t->name }}
                                </a>
                            </td>

                            <td>
                                {{ $t->identifier }}
                            </td>

                            <td>
                                <a href="{{ route('admin.content.typologies.show', $t->id) }}" class="btn btn-sm btn-success pull-right">Modifier</a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
</div>

@endsection
