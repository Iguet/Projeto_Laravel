@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="container">
            <h2>Projetos</h2>
            <form action=" {{ route('editaProjetos') }} " method="post">
                @csrf
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
                <input type="submit" class="btn btn-default btn-footer"  value="Editar">
            </form>
            <form action="{{ route('formProjetos') }}" method="get">
                <input type="submit" class="btn btn-default btn-footer"  value="Cadastrar">
            </form>
            {{-- <form action="{{ route('editaProjetos') }}" method="post">
                @csrf
                <input type="submit" class="btn btn-default btn-footer"  value="Editar">
            </form> --}}
        </div>
    </div>
@endsection