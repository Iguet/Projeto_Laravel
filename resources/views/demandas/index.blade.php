@extends('layouts.app')

{{-- @extends('demandas.cadastro') --}}
@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered tabela">
                <thead>
                    <tr>
                        <th></th>
                        <th>Projeto</th>
                        <th>Titulo</th>
                        <th>Descrição</th>
                        <th>Estado</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody id="tabela">
                </tbody>
            </table>
            <form method="get" action="{{ route('formDemandas') }}" >
                {{-- <input id="formEdita" type="button" class="btn btn-default btn-footer"  id="editarDemandas" value="editar" data-toggle="modal" data-target="#editaModal"> --}}
                <input id="Nova" type="submit" class="btn btn-default btn-footer" value="Cadastrar">
            </form>
        </div>
    </div>   
@endsection
    