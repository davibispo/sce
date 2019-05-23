@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$empresa->razao_soc}}</h3> 
                    <p>Adicionar Funcionário</p>
                    <a href="{{route('funcionarios.show', $empresa->id)}}" class="btn btn-default btn-xs" role="button">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>

                <div class="panel-body">
                    {!! Form::open(['class'=>'form-horizontal', 'name'=>'MainForm', 'method'=>'POST', 'action'=>['FuncionarioController@storeFuncionario',$empresa->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('nome', '* Nome', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nome', null, ['class'=>'form-control', 'placeholder'=>'Digite o nome completo..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('endereco', '* Endereço', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('endereco', null, ['class'=>'form-control', 'placeholder'=>'Digite o endereço..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('endereco_num', '* Nº', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('endereco_num', null, ['class'=>'form-control', 'placeholder'=>'Digite o número..', 'required','pattern="[0-9]+$"']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('bairro', '* Bairro', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('bairro', null, ['class'=>'form-control', 'placeholder'=>'Digite o bairro..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('uf', 'UF', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            <select name="uf" id="uf" class="form-control" required>
                                <option value="">-- Escolha o Estado --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cidade', 'Cidade', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            <select name="cidade" id="cidade" class="form-control" style="display:none;" required></select>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('telefone', '* Telefone', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('telefone', null, ['id'=>'telefone','class'=>'form-control', 'placeholder'=>'Digite o telefone..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'E-mail', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Digite o e-mail..']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('sexo', 'Sexo', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            F {!! Form::radio('sexo', 'F', ['class'=>'form-control', 'required']) !!}<br>
                            M {!! Form::radio('sexo', 'M', ['class'=>'form-control', 'required', 'checked']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('dt_nasc', '* Data de Nascimento', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('dt_nasc', null, ['class'=>'form-control', 'placeholder'=>'dd-mm-AAAA', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('dt_admis', 'Data de Admissão', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('dt_admis', null, ['class'=>'form-control', 'placeholder'=>'dd-mm-AAAA']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cargo', 'Cargo', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('cargo', null, ['class'=>'form-control','placeholder'=>'Digite o cargo..']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('salario', 'Salário', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('salario', null, ['class'=>'form-control', 'placeholder'=>'Digite o salário..']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cpf', '* CPF', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('cpf', null, ['class'=>'form-control', 'placeholder'=>'Apenas números..', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('pis', 'PIS', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('pis', null, ['class'=>'form-control', 'placeholder'=>'Digite o PIS..']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('rg', 'RG', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('rg', null, ['class'=>'form-control', 'placeholder'=>'Digite o RG..']) !!}
                        </div>
                    </div>

                    <div class="container">
                        <table style="margin-left:auto; margin-right: auto;">
                            <tr>
                                <td align="center">
                                    <div id="my_camera" style="width:260px; height:220px; border: 5px solid #ccc; margin: auto;"></div>
                                </td>
                                <td align="center">
                                    <div id="my_result" style="width:260px; height:220px; border: 5px solid #ccc; margin: auto;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><a href="javascript:void(take_snapshot())" class="btn btn-success">Tirar Foto</a></td>
                            </tr>
                        </table>

                    </div><br>    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Biometria</label>
                        <div class="col-md-6">
                            <input type="hidden" name="foto" id="foto">
                            <input type="hidden" name="digital">
                            <input type="button" onclick="regist()" class="btn btn-success" value="Registrar Biometria" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit('Adicionar Funcionário', ['class'=>'btn btn-primary']) !!}
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

<!-- Codigo para Foto-->
<script src="{{url('assets/js/webcamjs-master/webcam.min.js')}}"></script>
<script lang='javascript'>

    Webcam.set({
        width: 260,
        height: 220,
        dest_width: 260,
        dest_height: 220,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false,
        flip_horiz: true,
        fps: 45
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function (data_uri) {
            var foto = data_uri;
            //Mostra a captura da foto no formulário
            document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '"/>';
            //Salva a imagem no banco.
            document.getElementById('foto').value = foto;
            
        });
    }

</script>
<!-- FIM Codigo para Foto-->


<script lang='javascript'>

    var err, payload;
    var result = false;
    DEVICE_AUTO_DETECT = 255;
    var objNBioBSP = new ActiveXObject('NBioBSPCOM.NBioBSP.1');
    var objDevice = objNBioBSP.Device;
    var objExtraction = objNBioBSP.Extraction;
    var objMatching = objNBioBSP.Matching;
    var objIndexSearch = objNBioBSP.IndexSearch;
    var n = 0;
    var nUserID = objIndexSearch.UserID;


    function regist()
    {

        try // Exception handling
        {
            objDevice.Open(DEVICE_AUTO_DETECT);
            err = objDevice.ErrorCode;	// Get error code
            if (err !== 0)		// Device open failed
            {
                alert('Falha ao abrir leitor biométrico');
            } else
            {
                //objExtraction.Enroll(payload);
                objExtraction.Enroll(nUserID, 0);
                err = objExtraction.ErrorCode;	// Get error code
                if (err !== 0)		// Enroll failed
                {
                    alert('Registration failed ! Error Number : [' + err + ']');
                } else	// Enroll success
                {
                    objIndexSearch.AddFIR(objExtraction.TextEncodeFIR, nUserID);

                    //alert(nUserID);
                    alert('Digital capturada com sucesso!');
                    result = true;
                    //document.getElementsByName("digital").value = objExtraction.TextEncodeFIR;
                    //alert(document.getElementsByName("digital").value);
                    //document.MainForm.id_digital.value = nUserID;
                    document.MainForm.digital.value = objExtraction.TextEncodeFIR;
                }
                objDevice.Close(DEVICE_AUTO_DETECT);
            }
        } catch (e)
        {
            alert(e.message);
            return(false);
        }
        if (result)
        {
            // Submit main form

            //document.MainForm.submit();
        }
        return result;

    }
</script>

<!-- Script para Cidades e Estados -->
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



@endpush

