@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Relatórios Gerenciais</h3> 
                    <p>Eventos</p>
                    <a href="{{route('relatorios.index')}}" class="btn btn-default btn-xs" role="button">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" style="margin-top: 10px; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Eventos</th>
                                <th>Data</th>
                                <th>Local</th>
                                <th>Empresa</th>
                                <th>Cadastrados</th>
                                <th>Presentes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($eventos as $evento)
                            <tr>
                                <td><a href="{{route('relatorios.det', $evento->id)}}">{{$evento->descricao}}</a></td>
                                <td>{{date('d-m-Y', strtotime($evento->data))}}</td>
                                <td>{{$evento->local}}</td>
                                <td>
                                    {{DB::table('eventos')
                                                ->select('emp_responsavel')
                                                ->where('status','1')
                                                ->where('id',$evento->id)
                                                ->value('emp_responsavel')}}
                                </td>
                                <td>
                                    {{DB::table('participantes')
                                                ->select(DB::raw('count(*)'))
                                                ->where('evento_id', $evento->id)
                                                ->value('count')}}
                                </td>
                                <td>
                                    {{DB::table('credenciamentos')
                                                ->select(DB::raw('count(*)'))
                                                ->where('evento_id', $evento->id)
                                                ->where('empresa_id', $evento->empresa_id)
                                                ->where('presente','1')
                                                ->value('count')}}
                                </td>

                            </tr>
                            @empty
                            <div class="alert alert-warning">
                                <b>Ops!</b> Não há relatório!
                            </div>
                            @endforelse
                            <tr>
                                <th><a href="{{route('relatorios.exportarEventos')}}" class="btn btn-info btn-xs">Exportar CSV</a></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




