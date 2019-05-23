@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Editar Evento</h3> 
                    <p></p>
                </div>

                <div class="panel-body">
                    {!! Form::model($evento, ['class'=>'form-horizontal', 'method'=>'PATCH', 'action'=>['EventoController@update',$evento->id]]) !!}

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

@push('scripts')

@endpush




