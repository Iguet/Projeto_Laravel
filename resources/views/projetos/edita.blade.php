@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            {{-- <form class="form-group" action=" {{ route('updateProjetos', ['projetos' => $projetos->id]) }} " method="post"> --}}
                @csrf
                {{-- {{ $path }} --}}
                {{-- @method('PUT') --}}
                <div class="form-group">
                    {{-- <input type="hidden" name="idProjetos" value=" {{ $projetos->id }} "> --}}
                    <input class="form-control" type="text" name="nome" id="NomeEditaProjeto" placeholder="Nome" value="{{ $projetos->name }}">
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="descricao" id="DescricaoEditaProjeto" placeholder="Descricao">{{ $projetos->descricao }}</textarea>
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

                        {{-- @foreach ($users as $user)

                            <tr>
                                <td><input type="checkbox" checked name="id[]" value=" {{ $user->id }} "></td>
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                            </tr>    
                            @foreach ($array as $verifica)

                                @if ($verifica == true)
                                        <td><input type="checkbox" checked name="id[]" value=" {{ $user->id }} "></td>

                                @else
                                
                                        <td><input type="checkbox" name="id[]" value=" {{ $user->id }} "></td>
                                @endif

                            @endforeach

                        @endforeach --}}

                    </tbody>
                </table>
                    <input class="btn btn-inserir btn-default" type="submit" value="Editar" name="Projeto">
            {{-- </form> --}}
        </div>
    </div>

@endsection

@section('scripts')
    

    <script type="text/javascript">



        $(document).ready(function () {

            var array = [];
            var array = '{!! json_encode($array) !!}';
            // alert(array);
            var cont = 1;

            // alert(array);

            $('#tabela').DataTable({
                // responsive: true,
                // processing: true,
                // serverSide: true,
                ajax: {
                    url: 'http://localhost/projetaoLaravel/public/projetos/dataTables',
                    type: 'GET',
                },
                columns: [
                    {
                        render: function ( data, type, row ) {
                            return '<input type="checkbox" name="id[]" value='+cont+++' id="checkbox">';
                            return data;
                            cont++;
                        },
                    },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' }
                    // {data: 'nome'         , name: 'pessoas.nome'},
                ],

            });

            for (let i = 0; i < array.length; i++) {
                

                if(array[i] == 1){

                    $("input [value =   ]").prop('checked', true);

                }
                
            }

            // $('#tabela').DataTable({
            //     // responsive: true,
            //     // processing: true,
            //     // serverSide: true,
            //     ajax: {
            //         url: 'http://localhost/projetaoLaravel/public/projetos/dataTables',
            //         type: 'GET',
            //     },
            //     columns: [
            //         { }
            //         { data: 'id', name: 'id' },
            //         { data: 'name', name: 'name' },
            //         { data: 'email', name: 'email' }
            //         // {data: 'nome'         , name: 'pessoas.nome'},
            //     ],

            // });

        });

    </script>

@endsection
