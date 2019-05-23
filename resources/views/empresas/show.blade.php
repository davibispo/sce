@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$empresa->razao_soc}}</h3> 
                    <p>Detalhes</p>
                    <a href="{{route('empresas.index')}}" class="btn btn-default btn-xs" role="button">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Razão Social</td>
                                <td>{{ $empresa->razao_soc }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CNPJ</td>
                                <td>{{ $empresa->cnpj }}</td>
                            </tr>
                            <tr>
                                <td>Endereço</td>
                                <td>{{ $empresa->endereco }}</td>
                            </tr>
                            <tr>
                                <td>Nº</td>
                                <td>{{ $empresa->endereco_num }}</td>
                            </tr>
                            <tr>
                                <td>Bairro</td>
                                <td>{{ $empresa->bairro }}</td>
                            </tr>
                            <tr>
                                <td>Telefone</td>
                                <td>{{ $empresa->telefone }}</td>
                            </tr>
                            <tr>
                                <td>Cidade</td>
                                <td>{{ $empresa->cidade }}</td>
                            </tr>
                            <tr>
                                <td>UF</td>
                                <td>{{ $empresa->uf }}</td>
                            </tr>
                            <tr>
                                <td>Cadastrador</td>
                                <td>{{ $empresa->user_id }}</td>
                            </tr>
                            <tr>
                                <td>Data de cadastro</td>
                                <td>{{$empresa->created_at}} ({{$empresa->created_at->diffForhumans()}})</td>
                            </tr>
                            <tr>
                                <td>Última Atualização</td>
                                <td>{{$empresa->updated_at}} ({{$empresa->updated_at->diffForhumans()}}) </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{route('empresas.edit', $empresa->id)}}" class="btn btn-warning btn-xs" role="button">Editar Informações</a>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['EmpresaController@destroy',$empresa->id], 'style'=>'display:inline' ]) !!}
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

