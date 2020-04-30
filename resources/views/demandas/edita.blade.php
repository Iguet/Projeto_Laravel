@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Editar Demanda</h2>
        <div class="container">
            <form class="form-group" id="form"  action=" {{ route('updateDemandas', ['demandas' => $demandas->id]) }} " method="post" >
                @method('PUT')
                @csrf
                <div>
                    {{-- <input type="hidden" name="idDemanda" value=" {{ $demandas->id }} "> --}}
                    <label> Projetos </label>
                    {{-- <input type="disabled" value=" {{  }} "> --}}
                    <select class="form-control" name="Projeto">
                        <option disabled>Selecionar Projetos</option>
                        @foreach ($projetos as $projetos) 
                            @if ($projetos->id == $demandas->projeto_id)
                                <option class="autofocus" selected value="{{ $projetos->id }}">{{ $projetoDemandas->name}}</option>
                            @else
                                <option value="{{ $projetos->id }}">{{ $projetos->name }}</option>
                            @endif
                            {{-- <option value="{{ $projetos->id }}">{{ $projetos->name }}</option> --}}
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
