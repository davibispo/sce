@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$empresaRazaoSoc}}</h3> 
                    <p>Evento: <b>{{$evento->descricao}}</b></p>
                    
                    <a href="{{route('eventos.show', $btVolta)}}" class="btn btn-default btn-xs">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Evento</td>
                                <td>{{ $evento->descricao }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Local</td>
                                <td>{{ $evento->local }}</td>
                            </tr>
                            <tr>
                                <td>Data</td>
                                <td>{{ $evento->data }}</td>
                            </tr>
                            <tr>
                                <td>Última Atualização</td>
                                <td>{{$evento->updated_at}} ({{$evento->updated_at->diffForhumans()}}) </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{route('eventos.edit', $evento->id)}}" class="btn btn-warning btn-xs" role="button">Editar</a>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['EventoController@destroy',$evento->id], 'style'=>'display:inline' ]) !!}
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





