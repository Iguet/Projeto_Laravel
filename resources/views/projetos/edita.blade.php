@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <form class="form-group" action="editaProjeto.php" method="post">
                <div class="form-group">
                    <input type="hidden" name="idEditaProjeto">
                    <input class="form-control" type="text" name="nomeEditaProjeto" id="NomeEditaProjeto" placeholder="Nome">
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="descricaoEditaProjeto" id="DescricaoEditaProjeto" placeholder="Descricao"></textarea>
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
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                    <input class="btn btn-inserir btn-default" type="submit" id="editarProjeto" value="Editar Projeto" name="Projeto">
            </form>
        </div>
    </div>
@endsection
