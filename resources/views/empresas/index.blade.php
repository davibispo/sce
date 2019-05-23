@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Empresas</h3> 
                    <p>Lista</p>
                </div>
                <div class="panel-body">
                    <a href="{{ route('empresas.create')}}" class="btn btn-success btn-xs" role="button">Cadastrar Empresa</a>

                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Razão Social</th>
                                <th>CNPJ</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($empresas as $empresa)
                            <tr>
                                <td>{{ $empresa->razao_soc}}</td>
                                <td>{{ $empresa->cnpj}}</td>
                                <td>
                                    <a href="{{route('funcionarios.show', $empresa->id)}}" class="btn btn-primary btn-xs" role="button">Funcionários</a>
                                    <a href="{{route('eventos.show', $empresa->id)}}" class="btn btn-info btn-xs" role="button"><b>Eventos</b></a>
                                    <a href="{{route('empresas.show', $empresa->id)}}" class="btn btn-link btn-xs" role="button">Detalhes</a>                             
                                </td>

                            </tr>
                            @empty
                        <div class="alert alert-warning">
                            <strong>Ops!</strong> Não há empresas cadastradas!
                        </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
