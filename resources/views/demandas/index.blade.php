@extends('layouts.app')

@section('content')
    <div class="container">
        <form action=" {{ route('editaDemandas') }} " method="GET">
            <div class="row">
            <h2>Demandas</h2>
                @csrf
                <table class="table table-striped table-bordered tabela">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Projeto</th>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Estado</th>
                            <th>Data de Criação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $demandas)
                        <tr>
                            {{-- <input type="hidden" name="name" value=" {{ $demandas->name }} "> --}}
                                <td> <input type="radio" name="id" value=" {{ $demandas->id }} "> </td>
                                <td> {{ $demandas->name}} </td>
                                <td> {{ $demandas->titulo }} </td>
                                <td> {{ $demandas->descricao }} </td>
                                <td> {{ $demandas->estado }} </td>
                                <td> {{ $demandas->created_at }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input class="btn btn-default" type="submit" value="Editar">
            </form>
            <form method="get" action="{{ route('formDemandas') }}" >
                {{-- <input id="formEdita" type="button" class="btn btn-default btn-footer"  id="editarDemandas" value="editar" data-toggle="modal" data-target="#editaModal"> --}}
                <input id="Nova" type="submit" class="btn btn-default btn-footer" value="Cadastrar">
            </form>
        </div>
    </div>   
@endsection
    