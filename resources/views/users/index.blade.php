@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Usuários Cadastrados</h3> 
                    <p>Lista</p>
                </div>
                <div class="panel-body">
                    <a href="{{route('users.create')}}" class="btn btn-default btn-md" role="button">Cadastrar Usuário</a>

                    <table class="table table-striped" style="margin-top: 10px">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['UserController@destroy',$user->id], 'style'=>'display:inline' ]) !!}
                                        {!! Form::submit('Deletar', ['class'=>'btn btn-danger btn-xs']) !!}
                                    {!! Form::close()!!}
                                </td>

                            </tr>
                            @empty
                        <div class="alert alert-warning">
                            <strong>Ops!</strong> Não há usuários cadastrados!
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


