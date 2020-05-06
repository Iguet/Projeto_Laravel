@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Editar Demanda</h2>
        <div class="container">
            <form class="form-group" id="form"  action=" {{ route('updateDemandas', ['id' => $demandas->id]) }} " method="post" >
                @method('PUT')
                @csrf
                <div>
                    <label> Projetos </label>
                    <select class="form-control" id="selectProjeto" name="Projeto">
                        <option disabled>Selecionar Projetos</option>
                        @foreach ($projetos as $projetos) 
                            @if ($projetos->id == $demandas->projeto_id)
                                <option class="autofocus" selected value="{{ $projetos->id }}">{{ $projetoDemandas->name}}</option>
                            @else
                                <option value="{{ $projetos->id }}">{{ $projetos->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label> Usuarios </label>
                    <select class="form-control" id="select" name="User">
                        <option disabled selected> Selecionar Encarregado </option>
                            @foreach ($usersProjetos as $users) 
                                @if ($users->id == $userDemandas->id)
                                    <option class="autofocus" selected value="{{ $users->id }}">{{ $users->name}}</option>
                                @else
                                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                                @endif
                            @endforeach
                    </select>
                </div>
                <div>
                    <label> Titulo </label>
                    <input class="form-control" type="text" name="titulo" placeholder="Titulo" value="{{ $demandas->titulo }}">
                </div>
                <div>
                    <label> Descrição </label>
                    <input class="form-control" type="text" name="descricao" placeholder="Descrição" value="{{ $demandas->descricao }}">
                </div>
                <div>
                    <label> Estado </label>
                    <select class="form-control" name="estado" >
                        <option selected disabled> Selecionar Estado </option>
                        <option> Nova </option>
                        <option> Em Progresso </option>
                        <option> Parada </option>
                        <option> Finalizada </option>
                    </select>
                </div>
                    <input class="btn btn-inserir btn-default" type="submit" value="Editar" name="editaDemanda" id="editaDemanda">   
                <div>
            </form>
                <br>
                <h3> Comentarios </h3>
                <br>
                <form id="formComentario">
                    @csrf
                    <div>
                        <input class="form-control" type="text" name="comentario" id="comentario" placeholder="Escreva seu comentario">
                    </div>
                    <div>
                        <input class="btn btn-dark" type="submit" value="Comentar">
                    </div>
                </form>
                
                <p id="comentarios">
                    
                </p>
            </div>
            
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
    
    <script type="text/javascript">
    
        jQuery(document).ready(function(){

            var token = '{{csrf_token()}}';

            $(document).on('blur','#selectProjeto', function(){

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

                }).done(function(data) {

                    // console.log(data);
                    
                        for(var i = 0; data.id.length > i; i++){

                            // console.log(data.name[i]);


                            $('#select').append('<option value="'+data.id[i].id+'">'+data.name[i].name+'</option>');

                        }

                    });
                    
                    // complete: function(data){
                    //     console.log(data);
                    // }

                // });

            });

            var idDemanda = " {!! $demandas->id !!} "

            $.ajax({

                url: " {{ route('listaComentarios') }} ",
                type: 'POST',
                data: {

                    _token: token,
                    id: idDemanda,

                },
                dataType: 'json',
                success: function (data) {
                    // console.log(data);

                    for(var i = 0; i < data.dados.length; i++){

                        $('#comentarios').append('<ul class="list-group list-group-flush"><li class="list-group-item"><h6>' + data.dados[i].name + '</h6>' + data.dados[i].comentario + ' </li></ul>');

                    }

                },

                // complete: function (data) {
                    
                //     console.log(data);

                // }

            });

            $('#formComentario').submit(function(e) {

                // alert("FODASE");
                e.preventDefault();
                $('#comentario').empty();
                // $('#select').empty();

                $.ajax({

                    url: "{{ route('storeComentarios') }}",
                    type: "POST",
                    data: {

                        _token: token,
                        idDemanda: idDemanda,
                        comentario: $("#comentario").val(),

                    },
                    dataType: 'json',
                    success: function (data) {

                        console.log(data);
                        $('#comentarios').append('<ul class="list-group list-group-flush"><li class="list-group-item"><h6>'+data.dados.name+'</h6>'+data.dados.comentario+' </li></ul>');
                        // break;

                    },

                    complete: function (data) {

                        console.log(data);
                        
                    }

                });

            });

        });
    
    </script>

@endsection
