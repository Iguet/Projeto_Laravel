@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Cadastro de Demandas</h2><br>
        <div class="container">
            <form class="form-group cadastroprojeto" id="cadastro" action="{{ route('cadastroDemandas') }}"
                  method="post">
                @csrf
                <div class="form-group">
                    <select class="form-control listaProjeto" id="selectProjeto" name="projeto_id">
                        <option selected disabled>Projeto</option>
                        @foreach ($projetos as $projetos)
                            <option value="{{ $projetos->id }}">{{ $projetos->name }}</option>
                        @endforeach
                    </select>
                    @error('projeto_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-control" id="select" name="user_id">
                        <option selected disabled>Encarregado</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="titulo" id="Titulo" placeholder="Titulo">
                    @error('titulo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="descricao" id="Descricao" placeholder="Descrição"
                              rows="1"></textarea>
                    @error('descricao')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input class="btn btn-inserir btn-default" type="submit" value="Cadastrar Demanda" name="Demanda"
                           id="CriarDemanda">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js" defer></script>

    <script type="text/javascript">

        jQuery(document).ready(function () {

            var token = '{{csrf_token()}}';

            $(document).on('blur', '#selectProjeto', function () {

                $('#select').empty();
                $('#select').append('<option selected disabled> Selecionar Encarregado </option>');

                $.ajax({

                    url: "{{ url('/demandas/ajax') }}",
                    type: 'POST',
                    async: true,
                    data: {
                        _token: token,
                        idProjeto: $("#selectProjeto").val(),
                    },
                    dataType: 'json'

                }).done(function (data) {

                    // console.log(data);

                    for (var i = 0; data.id.length > i; i++) {

                        // console.log(data.name[i]);


                        $('#select').append('<option value="' + data.id[i].id + '">' + data.name[i].name + '</option>');

                    }

                });

                // complete: function(data){
                //     console.log(data);
                // }

                // });

            });

        });


    </script>

@endsection
