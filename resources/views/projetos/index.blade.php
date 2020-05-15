@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <h2>Projetos</h2>
            <form>

                @csrf
                <table class="table table-striped table-bordered tabela">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data de Criação</th>
                        @canany(['delete', 'update'], App\Projetos::class)

                            <th></th>

                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @can('update', App\Projetos::class)

                        @foreach ($projetos as $projetos)
                            <tr>
                                <td> {{ $projetos->name }} </td>
                                <td> {{ $projetos->descricao }} </td>
                                <td> {{ $projetos->created_at }} </td>
                                <td>
                                    <input type="submit" class="btn"
                                           formaction=" {{ route('destroyProjetos', ['id' => $projetos->id]) }} "
                                           formmethod="POST" value="Deletar">
                                    <input type="submit" class="btn"
                                           formaction=" {{ route('editaProjetos', ['id' => $projetos->id]) }} "
                                           formmethod="GET" value="Editar">
                                </td>
                            </tr>
                        @endforeach
                    @else

                        @foreach ($projetos as $projetos)
                            <tr>
                                <td> {{ $projetos->name }} </td>
                                <td> {{ $projetos->descricao }} </td>
                                <td> {{ $projetos->created_at }} </td>
                            </tr>
                        @endforeach

                    @endcan
                    </tbody>
                </table>
                @can('create', App\Projetos::class)

                    <input type="submit" dusk="criar" class="btn btn-default btn-footer" value="Cadastrar"
                           formaction=" {{ route('formProjetos') }} ">

                @endcan
            </form>
        </div>
    </div>

@endsection
