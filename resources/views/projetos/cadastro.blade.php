@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Cadastro de Projetos</h2>
        <div class="container">
            <form class="form-group CadastroProjeto" action="CadastroProjeto.php" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" name="nomeProjeto" id="NomeProjeto" placeholder="Nome">
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="descricaoProjeto" id="DescricaoProjeto" placeholder="Descricao"></textarea>
                </div>
                <table id="example" class="display" style="width:100%">
                <thead>
                    <h3> Pessoas </h3>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody id="tabelaPessoas">
                </tbody>
                </table>
                <input class="btn btn-inserir btn-default" type="submit" value="Cadastrar Projeto" name="Projeto">
            </form>
        </div>
    </div>
@endsection
