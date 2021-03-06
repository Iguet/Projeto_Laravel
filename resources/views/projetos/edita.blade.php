@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <form class="form-group"
                  action=" {{ route('updateProjetos', ['id' => $projetos->id]) }} " method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    {{-- <input type="hidden" name="idProjetos" value=" {{ $projetos->id }} "> --}}
                    <input class="form-control" type="text" name="name" id="NomeEditaProjeto" placeholder="Nome"
                           value="{{ $projetos->name }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="descricao" id="DescricaoEditaProjeto"
                              placeholder="Descricao">{{ $projetos->descricao }}</textarea>
                    @error('descricao')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <table class="table table-striped table-bordered" id="tabela">
                    <thead>
                    <h4> Pessoas </h4>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($tem as $user)

                        <tr>
                            <td><input type="checkbox" checked name="user_id[]" value=" {{ $user->id }} "></td>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                        </tr>

                    @endforeach
                    @foreach ($naotem as $verifica)

                        <tr>
                            <td><input type="checkbox" name="user_id[]" value=" {{ $verifica->id }} "></td>
                            <td> {{ $verifica->id }} </td>
                            <td> {{ $verifica->name }} </td>
                            <td> {{ $verifica->email }} </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
                <input class="btn btn-inserir btn-default" type="submit" value="Editar" name="Projeto">
            </form>
        </div>
    </div>

@endsection

@section('scripts')


    <script type="text/javascript">


        $(document).ready(function () {

            $('#tabela').DataTable();

        });

    </script>

@endsection
