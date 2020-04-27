@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <form class="form-group" action=" {{ route('updateProjetos') }} " method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="idProjetos" value=" {{ $projetos->id }} ">
                    <input class="form-control" type="text" name="nome" id="NomeEditaProjeto" placeholder="Nome" value="{{ $projetos->name }}">
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="descricao" id="DescricaoEditaProjeto" placeholder="Descricao">{{ $projetos->descricao }}</textarea>
                </div>
                <table class="table table-striped table-bordered tabela">
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
                                @if ($user->id)
                                    <td><input type="checkbox" checked name="id[]" value=" {{ $user->id }} "></td>
                                @else
                                    <td><input type="checkbox" name="id[]" value=" {{ $user->id }} "></td>
                                @endif
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <input class="btn btn-inserir btn-default" type="submit" value="Editar" name="Projeto">
            </form>
        </div>
    </div>
@endsection
