@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Listes des e-mails type
                        <a href="{{route('rrhh.admin.emailstemplates.create')}}" class="pull-right btn btn-primary">
                            Ajouter un template
                        </a>
                    </h3>
    				<h6 class="card-subtitle mb-2 text-muted">Configuration des listes des formulaires</h6>

                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Identifiant</th>
                            <th></th>
                        </tr>
                        @foreach($templates as $template)
                        <tr>
                            <td width="50">
                                {{ $template->id }}
                            </td>

                            <td>
                                <a href="{{ route('rrhh.admin.emailstemplates.show', $template) }}">
                                    {{ $template->subject }}
                                </a>
                            </td>

                            <td>
                                {{ $template->identifier }}
                            </td>

                            <td class="text-right">
                                {!!
                                    Form::open([
                                        'url' => route('rrhh.admin.emailstemplates.delete', $template),
                                        'method' => 'POST',
                                        'class' => 'toggle-delete'
                                    ])
                                !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Supprimer" class="btn btn-link" />
                                    <a href="{{ route('rrhh.admin.emailstemplates.show', $template) }}" class="btn btn-link"><i title="{{Lang::get('architect::datatables.edit')}}" class="fa fa-pencil"></i></a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
