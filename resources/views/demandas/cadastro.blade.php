@extends('layouts.app')

@section('content')  
<div class="container">
  <h2 class="display-4">Cadastro de Demandas</h2><br>
  <div class="container">
    <form class="form-group cadastroprojeto" action="{{ route('cadastroDemandas') }}" method="post">
      @csrf
      <div class="form-group">
        <select class="form-control listaProjeto" name="Projeto">
          <option>Projeto</option>
          @foreach ($projetos as $projetos) 
            <option value="{{ $projetos->id }}">{{ $projetos->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <select class="form-control" name="User">
          <option>Encarregado</option>
          @foreach ($users as $user) 
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="Titulo" id="Titulo" placeholder="Titulo">
      </div>
      <div class="form-group">
        <textarea class="form-control" type="text" name="Descricao" id="Descricao" placeholder="Descrição" rows="1"></textarea>
      </div>
      <div>
        <input class="btn btn-inserir btn-default" type="submit" value="Cadastrar Demanda" name="Demanda" id="CriarDemanda">
      </div>
    </form>
  </div>
</div>

@endsection