@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Detalhes do Funcionário</h3> 
                    <a href="{{route('empresas.index')}}" class="btn btn-default btn-xs" role="button">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Nome Completo</td>
                                <td>{{ $funcionario->nome }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Endereço</td>
                                <td>{{ $funcionario->endereco }}</td>
                            </tr>
                            <tr>
                                <td>Nº</td>
                                <td>{{ $funcionario->endereco_num }}</td>
                            </tr>
                            <tr>
                                <td>Bairro</td>
                                <td>{{ $funcionario->bairro }}</td>
                            </tr>
                            <tr>
                                <td>UF</td>
                                <td>{{ $funcionario->uf }}</td>
                            </tr>
                            <tr>
                                <td>Cidade</td>
                                <td>{{ $funcionario->cidade }}</td>
                            </tr>
                            <tr>
                                <td>Telefone</td>
                                <td>{{ $funcionario->telefone }}</td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td>{{ $funcionario->email }}</td>
                            </tr>
                            <tr>
                                <td>Sexo</td>
                                <td>{{ $funcionario->sexo }}</td>
                            </tr>
                            <tr>
                                <td>Data Nascimento</td>
                                <td>{{date('d-m-Y', strtotime($funcionario->dt_nasc))}}</td>
                            </tr>
                            <tr>
                                <td>Empresa</td>
                                <td>{{ $funcionario->empresa }}</td>
                            </tr>
                            <tr>
                                <td>Data Admissão</td>
                                <td>{{date('d-m-Y', strtotime($funcionario->dt_admis))}}</td>
                            </tr>
                            <tr>
                                <td>Cargo</td>
                                <td>{{ $funcionario->cargo }}</td>
                            </tr>
                            <tr>
                                <td>Salário</td>
                                <td>{{ $funcionario->salario }}</td>
                            </tr>
                            <tr>
                                <td>CPF</td>
                                <td>{{ $funcionario->cpf }}</td>
                            </tr>
                            <tr>
                                <td>PIS</td>
                                <td>{{ $funcionario->pis }}</td>
                            </tr>
                            <tr>
                                <td>RG</td>
                                <td>{{ $funcionario->rg }}</td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td><img src="{{ $funcionario->foto }}"></td>
                            </tr>

                            <tr>
                                <td>Cadastrador</td>
                                <td>{{$funcionario->user_id}}</td>
                            </tr>
                            <tr>
                                <td>Data de cadastro</td>
                                <td>{{$funcionario->created_at}} ({{$funcionario->created_at->diffForhumans()}})</td>
                            </tr>
                            <tr>
                                <td>Última Atualização</td>
                                <td>{{$funcionario->updated_at}} ({{$funcionario->updated_at->diffForhumans()}}) </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{route('funcionarios.edit', $funcionario->id)}}" class="btn btn-warning btn-xs" role="button">Editar informações</a>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['FuncionarioController@destroy',$funcionario->id], 'style'=>'display:inline' ]) !!}
                                        {!! Form::submit('Deletar', ['class'=>'btn btn-danger btn-xs']) !!}
                                    {!! Form::close()!!}
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



