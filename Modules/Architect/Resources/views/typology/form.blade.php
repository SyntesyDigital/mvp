@extends('architect::layouts.master')

@section('content')

    <div id="component-typology-modal-settings"></div>

    <div class="col-md-offset-1  col-md-7">
        <div class="card">
            <div class="card-body jsonbuilder">
                <div class="">
                    <input type="text" value="" />
                    <a href="#" data-rules="required|numeric" data-settings="entries_type:event,article,category">settings</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <ul>
                    @foreach(Config('fields') as $f)
                        <li>
                            <a href="#">{{$f['name']}}</a>
                        </li>
                    @endforeach()
                </ul>
            </div>
        </div>
    </div>
@stop
