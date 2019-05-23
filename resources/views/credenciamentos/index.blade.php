@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$evento->descricao}}</h3> 
                    <p><b>Credenciamento</b></p>
                    <a href="{{route('eventos.show', $btVolta)}}" class="btn btn-default btn-xs">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>
                <div class="panel-body">
                    {!! Form::open(['class'=>'form-horizontal', 'name'=>'MainForm', 'method'=>'POST', 'action'=>['CredenciamentoController@storeCredenciamento',$evento->id]]) !!}

                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-6">

                            <input type="submit" value="Buscar Digital" class="btn btn-success"> 
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Presentes
                                    <span class="badge">
                                        {{DB::table('credenciamentos')
                                                ->select(DB::raw('count(*)'))
                                                ->where('evento_id', $evento->id)
                                                ->where('empresa_id', $evento->empresa_id)
                                                ->where('presente','1')
                                                ->value('count')}}
                                    </span> 
                                </th>
                                <th>CPF</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($credenciados as $credenciado)
                            <tr>
                                <td>{{$credenciado->nome}}</td>
                                <td>{{$credenciado->cpf}}</td>
                                <td><img src="{{$credenciado->foto}}" width="80"></td>
                            </tr>
                        </tbody>
                        @empty
                        <div class="alert alert-warning">
                            <strong>Ops!</strong> Ainda não há participantes presentes neste evento!
                        </div>
                        @endforelse

                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script lang='javascript'>
    var err, payload;
    var result = false;
    NBioAPI_DEVICE_ID_AUTO_DETECT = 255;

    var objNBioBSP = new ActiveXObject('NBioBSPCOM.NBioBSP.1'); // Cria o objeto principal
    var objDevice = objNBioBSP.Device; // Objeto com os métodos que abre e fecha o sensor
    var objExtraction = objNBioBSP.Extraction; //Objeto que com métodos de captura
    var objMatching = objNBioBSP.Matching; //Objeto com os métodos de verificação do tipo 1:1. Não usado neste sistema.
    var objIndexSearch = objNBioBSP.IndexSearch; // Cria o IndexSearch: Bando de digitias que ficará armazenado na memória do pc.

    $("form").submit(function (event) {
        var form = $(this);
        event.preventDefault();

        objDevice.Close(NBioAPI_DEVICE_ID_AUTO_DETECT);
        // Abre o sensor
        objDevice.Open(NBioAPI_DEVICE_ID_AUTO_DETECT);
        err = objDevice.ErrorCode;	// Get error code

        // Determinal que a captura será sem o POP-UP
        objExtraction.WindowStyle = 0;
        // Determina que o tempo de captura do sensor será de 4 segundos
        objExtraction.DefaultTimeout = 4000;
        // Realiza a captura
        objExtraction.Capture(1);

        /// ajax chama a url e pega as informações que ela retorna
        // no caso a nossa url chama a função buscaParticipante que retorna um json com todos os participantes
        // se der sucesso ele chama a função success, com o resultado da url na variavel participantes
        $.ajax({
            url: "{{route('participantes.buscaParticipante',$evento->id)}}",
            success: function (participantes) {
                //Determina que o tempo de busca no IndexSearch será de no máximo 5 segundos.
                objIndexSearch.MaxSearchTime = 5000;
                // só iniciei as variaveis aqui para salvar os dados.
                var isCadastrado = false;
                var participanteCadastrado = null;

                // para cada particpante dentro do array participantes ele vai fazer uma interação
                $.each(participantes, function (i, participante) {
                    // pega a digital do participante para comparar
                    objMatching.VerifyMatch(participante.digital, objExtraction.TextEncodeFIR);

                    // se achou
                    if (objMatching.MatchingResult !== 0) {
                        alert(participante.nome +'\nCPF: '+ participante.cpf +'\n'+ '\nCredenciado com Sucesso!' +'\n'+ '\nAtualize a Página!');
                        // parametros que quero enviar para minha url
                        var data = {
                            nome: participante.nome,
                            cpf: participante.cpf,
                            digital: participante.digital,
                            foto: participante.foto,
                            funcionario_id: participante.funcionario_id,
                            presente: '1',
                            _token: $("input[name=_token]").val()
                        };

                        // objeto com parametros para fazer o ajax
                        var ajax = {
                            method: "POST", // especificando que é post
                            url: form.attr('action'), // pegando o action do form
                            data: data, // passando os paremtros de cima
                            dataType: 'json', // especificando que o retorno deve ser um json
                            success: function (result) {
                                //console.log(result);
                                if (result.success) {
                                    //alert(result.mensage);
                                    //alert('aqui deve redirecionar para '+result.url_retorno);
                                } else {
                                    //alert(result.mensage);
                                }
                            }
                        };
                        // faz a chamada ajax
                        $.ajax(ajax);

                        return false;
                    } else {
                        //alert('Não cadastrado!');
                    }

                });

                objDevice.Close(NBioAPI_DEVICE_ID_AUTO_DETECT);
            }});
        objMatching = nothing;
        objNBioBSP = nothing;
    });
</script>

@endpush

