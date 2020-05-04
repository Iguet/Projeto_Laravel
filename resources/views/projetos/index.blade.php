@extends('layouts.app')

@section('content')  
    <div class="container">
        <div class="container">
            <h2>Projetos</h2>
            <form>
                
                @csrf
                <table class="table table-striped table-bordered tabela">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Data de Criação</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projetos as $projetos)
                            <tr>
                                {{-- <td><input type="radio" id="Radio" name="id[]" value=" {{ $projetos->id }} "></td> --}}
                                <td> {{ $projetos->name }} </td>
                                <td> {{ $projetos->descricao }} </td>
                                <td> {{ $projetos->created_at }} </td>
                                <td> <input type="submit" class="btn" formaction=" {{ route('destroyProjetos', ['id' => $projetos->id]) }} " formmethod="POST" value="Deletar"> </td>
                                <td> <input type="submit" class="btn" formaction=" {{ route('editaProjetos', ['id' => $projetos->id]) }} " formmethod="GET" value="Editar"> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <input type="submit" id="EditarProjeto" class="btn btn-default btn-footer"  value="Editar"> --}}
                <input type="submit" class="btn btn-default btn-footer"  value="Cadastrar" formaction=" {{ route('formProjetos') }} ">
            </form>
            {{-- <form action="{{ route('editaProjetos') }}" method="post">
                @csrf
                <input type="submit" class="btn btn-default btn-footer"  value="Editar">
            </form> --}}
        </div>
    </div>
    
@endsection