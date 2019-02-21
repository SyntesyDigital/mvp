@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des catégories
                        <a href="{{route('admin.content.categories.create')}}" class="pull-right btn btn-primary">
                            Créer une catégorie
                        </a>
                    </h3>
    				<h6 class="card-subtitle mb-2 text-muted">...</h6>

                    <table class="table" id="crosslinks-table">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Identifiant</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                        @if($categories)
                            @foreach($categories as $c)
                            <tr>
                                <td width="50">
                                    {{ $c->id }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.content.categories.show', $c->id) }}">
                                        {{ $c->name }}
                                    </a>
                                </td>

                                <td>
                                    {{ $c->identifier }}
                                </td>

                                <td>
                	                @if($c->status == 0)
                	                	<i class="fa fa-circle" style="color:#f7a300"></i> Inactive
                	                @else
                	                	<i class="fa fa-circle" style="color:#55bf09"></i> Active
                	                @endif
                	            </td>

                                <td>
                                    <a href="{{ route('admin.content.categories.show', $c->id) }}" class="btn btn-sm btn-success pull-right">Modifier</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
