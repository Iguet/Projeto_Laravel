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
                        <option> Selecionar Encarregado </option>
                            @foreach ($users as $users) 
                                @if ($users->id == $userDemandas->has('id'))
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
                    <select class="form-control" name="estado">
                        <option selected disabled> Estado Atual: {{ $demandas->estado }} </option>
                        <option> Nova </option>
                        <option> Em Progresso </option>
                        <option> Parada </option>
                        <option> Finalizada </option>
                    </select>
                </div>
                    <input class="btn btn-inserir btn-default" type="submit" value="Editar" name="editaDemanda" id="editaDemanda">    
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
    
    <script type="text/javascript">
    
        jQuery(document).ready(function(){

            // alert("FODASE");
            // var id = ;
            var token = '{{csrf_token()}}';


            $(document).on('blur','#selectProjeto', function(){

                $.ajax({

                    url: "{{ url('/demandas/ajax') }}",
                    type: 'POST',
                    async: true,
                    data: {
                        _token: token,
                        idProjeto: $("#selectProjeto").val(),
                    },
                    dataType:  'json'

                }).done(function(data) {

                    // console.log(data);
                        $('#select').empty();
                        $('#select').append('<option> Selecionar Encarregado </option>');
                    
                        for(var i = 0; data.id.length > i; i++){

                            // console.log(data.name[i]);


                            $('#select').append('<option value="'+data.id[i].id+'">'+data.name[i].name+'</option>');

                        }

                    });
                    
                    // complete: function(data){
                    //     console.log(data);
                    // }

                // });
               


            // alert(token);
                // $.ajax({

                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     url: "{{ route('ajaxDemandas') }}",//Definindo o arquivo onde serão buscados os dados
                //     type: 'post',		//Definimos o método HTTP usado
                //     dataType: 'json',	//Definimos o tipo de retorno
                //     data : {
                //         idProjeto : id,
                //         _token: token,
                //     },
                //     sucess: function(dados) {
                        
                //         alert(dados);

                //     },

                // });
            

            });

        });
    
    </script>

@endsection
