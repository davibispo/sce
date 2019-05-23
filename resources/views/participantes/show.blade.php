@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$evento->descricao}}</h3> 
                    <p>
                        Data: <b>{{date('d-m-Y', strtotime($evento->data))}}</b> |  
                        Local: <b>{{$evento->local}}</b> |
                        Empresa: <b>{{$empresaRazaoSoc}}</b> 
                    </p>

                    <div class="form-group">
                        <a href="{{route('eventos.show', $btVolta)}}" class="btn btn-default btn-xs">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                        </a>
                        <a href="{{route('participantes.create', $evento->id)}}" class="btn btn-default btn-xs">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar Participante Não cadastrado
                        </a>
                    </div>
                    <div class="form-group">
                    </div>

                    {!! Form::open(['class'=>'form-horizontal', 'method'=>'POST', 'action'=>['ParticipanteController@storeParticipante', $evento->id]]) !!}
                    <div class="form-group">
                        <div class="col-md-6">
                            <select name="emp_participante" class="form-control">
                                <option value=""><b>Adicionar Empresa(s) Participante(s)</b></option>
                                @foreach($empresas as $empresa)
                                <option value="{{$empresa->razao_soc}}">{{$empresa->razao_soc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="Adicionar" class="btn btn-primary btn-md">
                    </div>
                    {!! Form::close() !!}

                    
                </div>
                <div class="panel-body">
                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Pré-credenciados</th>
                                <th>CPF</th>
                                <th>Empresa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participantes as $participante)
                            <tr>
                                <td>{{$participante->nome}}</td>
                                <td>{{$participante->cpf}}</td>
                                <td>{{$participante->empresa}}</td>
                            </tr>
                            @empty
                        <div class="alert alert-warning">
                            <b>Ops!</b> Não há participantes cadastrados para este evento!
                        </div>
                        @endforelse
                        <tr>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['ParticipanteController@destroy',$evento->id], 'style'=>'display:inline' ]) !!}
                                {!! Form::submit('Limpar', ['class'=>'btn btn-danger btn-xs']) !!}
                            {!! Form::close()!!}
                        </td>
                            <a href="{{route('credenciamentos.index', $evento->id)}}" class="btn btn-success btn-xs" role="button">Ir para Credenciamento</a>
                        <td>
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









