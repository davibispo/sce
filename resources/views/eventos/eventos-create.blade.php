@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$empresa->razao_soc}}</h3> 
                    <p>Adicionar Evento</p>
                    <a href="{{route('eventos.show', $empresa->id)}}" class="btn btn-default btn-xs">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>

                <div class="panel-body">
                    {!! Form::open(['class'=>'form-horizontal', 'method'=>'POST', 'action'=>['EventoController@storeEvento',$empresa->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('descricao', 'Nome', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('descricao', null, ['class'=>'form-control', 'placeholder'=>'Digite o evento', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('local', 'Local', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('local', null, ['class'=>'form-control', 'placeholder'=>'Digite o local do evento..', 'required']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('data', 'Data do evento', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::date('data', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="hidden" name="emp_participante" value="{{$empresa->razao_soc}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit('Adicionar Evento', ['class'=>'btn btn-info']) !!}
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

@endpush


