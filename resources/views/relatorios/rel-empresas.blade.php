@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Relatórios Gerenciais</h3> 
                    <p>Empresas cadastradas</p>
                    <a href="{{route('relatorios.index')}}" class="btn btn-default btn-xs" role="button">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Razão Social</th>
                                <th>CNPJ</th>
                                <th>Data Cadastro</th>
                                <th>Qtd Func.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eventos as $evento)
                            @endforeach

                            @forelse($empresas as $empresa)
                            <tr>
                                <td>{{$empresa->razao_soc}}</td>
                                <td>{{$empresa->cnpj}}</td>
                                <td>{{date('d-m-Y', strtotime($empresa->created_at))}}</td>
                                <td>{{DB::table('funcionarios')
                                            ->select(DB::raw('count(*)'))
                                            ->where('empresa_id', $empresa->id)
                                            ->where('status', '1')
                                            ->value('count')}}</td>

                            @empty
                            <div class="alert alert-warning">
                                <b>Ops!</b> Não há relatório!
                            </div>
                        @endforelse

                        <tr>
                            <td><a href="{{route('relatorios.exportarEmpresas')}}" class="btn btn-info btn-xs">Exportar CSV</a></td>
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


