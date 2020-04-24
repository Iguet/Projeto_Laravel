@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="container">
            <table class="table table-striped table-bordered tabela">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projetos as $projetos)
                        <tr>
                            <td><input type="checkbox" name="id[]" value=" {{ $projetos->id }} "></td>
                            <td> {{ $projetos->name }} </td>
                            <td> {{ $projetos->descricao }} </td>
                            <td> {{ $projetos->created_at }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="{{ route('formProjetos') }}" method="get">
                {{-- <input id="formEditaProjeto" type="button" class="btn btn-default btn-footer"  value="Editar" data-toggle="modal" data-target="#edita-projetoModal"> --}}
                <input type="submit" class="btn btn-default btn-footer"  value="Cadastrar" data-toggle="modal">
            </form>
        </div>
    </div>
@endsection