@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$empresa->razao_soc}}</h3> 
                    <p>Eventos</p>
                </div>
                <div class="panel-body">
                    <a href="{{route('empresas.index')}}" class="btn btn-default btn-xs" role="button" data-toggle="tooltip" title="Voltar">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                    <a href="{{route('eventos.create', $empresa->id)}}" class="btn btn-info btn-xs" role="button">Adicionar Evento</a>
                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Evento</th>
                                <th>Data</th>
                                <th>Local</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($eventos as $evento)
                            <tr>
                                <td>{{$evento->descricao}}</td>
                                <td>{{date('d-m-Y', strtotime($evento->data))}}</td>
                                <td>{{$evento->local}}</td>
                                
                                <td>
                                    <a href="{{route('participantes.show', $evento->id)}}" class="btn btn-primary btn-xs" role="button">Participantes</a>
                                    <a href="{{route('credenciamentos.index', $evento->id)}}" class="btn btn-success btn-xs" role="button"><b>Credenciamento</b></a>
                                    <a href="{{route('eventos.detalhe', $evento->id)}}" class="btn btn-link btn-xs" role="button">Detalhes</a>
                                </td>

                            </tr>
                            @empty
                        <div class="alert alert-warning">
                            <strong>Ops!</strong> Não há eventos cadastrados para esta empresa!
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



