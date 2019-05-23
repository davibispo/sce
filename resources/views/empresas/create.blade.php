@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Cadastrar Empresa</h3> 
                    <a href="{{route('empresas.index')}}" class="btn btn-default btn-xs" role="button">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>

                <div class="panel-body">
                    {!! Form::open(['class'=>'form-horizontal', 'method'=>'POST', 'action'=>'EmpresaController@store']) !!}

                    <div class="form-group">
                        {!! Form::label('razao_soc', 'Razão Social', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('razao_soc', null, ['class'=>'form-control', 'placeholder'=>'Razão Social da Empresa..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cnpj', 'CNPJ', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('cnpj', null, ['class'=>'form-control', 'placeholder'=>'Apenas números', 'required']) !!}
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
                            {!! Form::text('endereco_num', null, ['class'=>'form-control','placeholder'=>'Apenas números.', 'required']) !!}
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
                            {!! Form::tel('telefone', null, ['class'=>'form-control', 'placeholder'=>'Apenas números', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('uf_id', 'UF', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            <select name="uf" id="uf" class="form-control" required>
                                <option value="">-- Escolha o Estado --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cidade_id', 'Cidade', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            <select name="cidade" id="cidade" class="form-control" style="display:none;" required></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit('Cadastrar Empresa', ['class'=>'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function () {
//verificar
    $.ajax({
        url: 'https://gist.githubusercontent.com/letanure/3012978/raw/36fc21d9e2fc45c078e0e0e07cce3c81965db8f9/estados-cidades.json'
        , type: 'GET'
        , dataType: 'json'
        , cache: true
        , success: function (json) {
            //Fala que o json a Var global json (window.json) é json
            window.json = json;

            var seletorUf = $("#uf");
            for (i in json.estados) {
                var estado = json.estados[i];
                $("<option />", {value: estado.sigla, text: estado.nome}).appendTo(seletorUf);
            }
        }
        , error: function (json) {
            //console.log(json);
        }
    });

    $("#uf").bind("change", function () {
        var ufSelecionado = $(this).val();

        var selectCidades = $("#cidade");
        selectCidades.empty();
        selectCidades.show();

//Percorre todo o Loop de estados
        for (i in json.estados) {
            var estado = json.estados[i];

            //Caso a sigla seja a mesma selecionada
            if (estado.sigla === ufSelecionado) {
                for (x in estado.cidades) {
                    var cidade = estado.cidades[x];
                    $("<option />", {value: x.cidades, text: cidade}).appendTo(selectCidades);
                }

                //Break loop (Improve performace?)
                return false;
            }
        }
    });
});
</script>

