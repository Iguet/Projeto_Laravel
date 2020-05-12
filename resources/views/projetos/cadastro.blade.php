@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Cadastro de Projetos</h2>
        <div class="container">
            <form class="form-group CadastroProjeto" action="{{ route('cadastroProjetos') }}" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Nome">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="descricao" placeholder="Descricao"></textarea>
                    @error('descricao')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <table class="display table table-striped table-bordered tabela" style="width:100%">
                    <thead>
                    <h3> Pessoas </h3>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            @csrf
                            <td><input type="checkbox" name="id[]" value=" {{ $user->id }} "></td>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input class="btn btn-inserir btn-default" type="submit" value="Cadastrar Projeto" name="Projeto">
            </form>
        </div>
    </div>
@endsection
