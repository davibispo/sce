@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Relatórios Gerenciais</h3> 
                    <p></p>
                    <a href="{{route('relatorios.evento')}}" class="btn btn-default btn-xs" role="button">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Credenciados</th>
                                <th>CPF</th>
                                <th>Evento</th>
                                <th>Empresa</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($credenciados as $credenciado)
                            <tr>
                                <td>{{$credenciado->nome}}</td>
                                <td>{{$credenciado->cpf}}</td>
                                <td>{{$credenciado->evento}}</td>
                                <td>{{$credenciado->empresa}}</td>
                                <td>{{date('d-m-Y', strtotime($credenciado->created_at))}}</td>

                            </tr>
                            @empty
                            <div class="alert alert-warning">
                                <b>Ops!</b> Não há relatório disponível!
                            </div>
                            @endforelse
                            <tr>
                            <td><a href="{{route('relatorios.exportarEventosDet')}}" class="btn btn-info btn-xs">Exportar CSV</a></td>
                            <td></td>
                            <td></td>
                            <td></td>
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



