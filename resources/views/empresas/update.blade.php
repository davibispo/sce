@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$empresa->razao_soc}}</h3> 
                    <p>Editar Informações</p>
                </div>

                <div class="panel-body">
                    {!! Form::model($empresa, ['class'=>'form-horizontal', 'method'=>'PATCH', 'action'=>['EmpresaController@update', $empresa->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('razao_soc', 'Razão Social', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('razao_soc', null, ['class'=>'form-control', 'placeholder'=>'Razão Social da Empresa..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cnpj', 'CNPJ', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('cnpj', null, ['class'=>'form-control', 'placeholder'=>'Digite o CNPJ..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('endereco', 'Endereço', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('endereco', null, ['class'=>'form-control', 'placeholder'=>'Digite o endereço..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('endereco_num', 'Nº', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::number('endereco_num', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('bairro', 'Bairro', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('bairro', null, ['class'=>'form-control', 'placeholder'=>'Digite o bairro..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('telefone', 'Telefone', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::tel('telefone', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('uf_id', 'UF', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            <select name="uf_id" class="form-control">
                                <option value="">Selecione</option>
                                @foreach($ufs as $uf)
                                <option value="{{$uf->id}}">{{$uf->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cidade_id', 'Cidade', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            <select name="cidade_id" class="form-control">
                                <option value="">Selecione</option>
                                @foreach($cidades as $cidade)
                                <option value="{{$cidade->id}}">{{$cidade->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit('Atualizar', ['class'=>'btn btn-warning']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

