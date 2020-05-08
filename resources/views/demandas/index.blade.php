@extends('layouts.app')

@section('content')
    <div class="container">
        <form>
            @csrf
            <div class="row">
            <h2>Demandas</h2>
                <table class="table table-striped table-bordered tabela">
                    <thead>
                        <tr>
                            {{-- <th></th> --}}
                            <th>Projeto</th>
                            <th>Encarregado</th>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Estado</th>
                            <th>Data de Criação</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @hasanyrole('Admin Demandas|Admin')

                            @foreach ($dados as $demandas)
                            <tr>

                                {{-- @method('DELETE') --}}
                                <td> {{ $demandas->nomeProjeto}} </td>
                                <td> {{ $demandas->name }} </td>
                                <td> {{ $demandas->titulo }} </td>
                                <td> {{ $demandas->descricao }} </td>
                                <td> {{ $demandas->estado }} </td>
                                <td> {{ $demandas->created_at }} </td>
                                <td> 

                                    <input type="submit" class="btn" formaction=" {{ route('destroyDemandas', ['id' => $demandas->id]) }} " formmethod="POST" value="Deletar">
                                    <input type="submit" class="btn" formaction=" {{ route('editaDemandas', ['id' => $demandas->id, 'idProjeto' => $demandas->idProjeto]) }} " formmethod="GET" value="Editar"> 

                                </td>
                            </tr>
                        @endforeach
                    @else

                        @foreach ($dados as $demandas)
                            <tr>

                                {{-- @method('DELETE') --}}
                                <td> {{ $demandas->nomeProjeto}} </td>
                                <td> {{ $demandas->name }} </td>
                                <td> {{ $demandas->titulo }} </td>
                                <td> {{ $demandas->descricao }} </td>
                                <td> {{ $demandas->estado }} </td>
                                <td> {{ $demandas->created_at }} </td>
                                <td><input type="submit" class="btn" formaction=" {{ route('editaDemandas', ['id' => $demandas->id, 'idProjeto' => $demandas->idProjeto]) }} " formmethod="GET" value="Vizualizar"></td> 
                            </tr>
                        @endforeach
                    @endhasanyrole
                    </tbody>
                </table>
                @can('create', App\Demandas::class)
                    
                    <input type="submit" class="btn" formmethod="GET" formaction=" {{ route('formDemandas') }} " value="Cadastrar">
                    
                @endcan
            </form>
        </div>
    </div>   
@endsection

    