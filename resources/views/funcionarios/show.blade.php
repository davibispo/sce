@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$empresa->razao_soc}}</h3> 
                    <p>Funcionários</p>
                </div>
                <div class="panel-body">
                    <a href="{{route('empresas.index')}}" class="btn btn-default btn-xs" role="button" data-toggle="tooltip" title="Voltar">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                    <a href="{{route('funcionarios.create', $empresa->id)}}" class="btn btn-primary btn-xs" role="button">
                        <i class="fa fa-plus" aria-hidden="true"></i> Adicionar Funcionário
                    </a>
                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($funcionarios as $funcionario)
                            <tr>
                                <td>{{$funcionario->nome}}</td>
                                <td>{{$funcionario->cpf}}</td>
                                <td>
                                    <a href="{{route('funcionarios.detalhe', $funcionario->id)}}" class="btn btn-default btn-xs" role="button">Detalhes</a>
                                </td>

                            </tr>
                            @empty
                        <div class="alert alert-warning">
                            <strong>Ops!</strong> Não há funcionários cadastrados para esta empresa!
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


