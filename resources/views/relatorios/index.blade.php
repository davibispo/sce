@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Relatórios Gerenciais</h3> 
                    <p></p>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{route('relatorios.empresa')}}">Empresas</a></td>
                                <td><span class="badge">{{$empresas->count()}}</span></td>
                            </tr>
                            <tr>
                                <td><a href="{{route('relatorios.evento')}}">Eventos</a></td>
                                <td><span class="badge">{{$eventos->count()}}</span></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


