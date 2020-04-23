@extends('layouts.app')

@section('content')  
    <div class="jumbotron">
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
                <tbody id="tabelaProjeto">
                </tbody>
            </table>
            <form action="{{ route('formProjetos') }}" method="get">
                {{-- <input id="formEditaProjeto" type="button" class="btn btn-default btn-footer"  value="Editar" data-toggle="modal" data-target="#edita-projetoModal"> --}}
                <input type="submit" class="btn btn-default btn-footer"  value="Cadastrar" data-toggle="modal">
            </form>
        </div>
    </div>
@endsection