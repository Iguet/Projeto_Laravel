@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Editar Permissões</h2>
        <div class="container">
            <form class="form-group" id="form" action=" {{ route('updatePermissions') }} " method="post">
                @csrf
                <div>
                    <label> Usuarios </label>
                    <select class="form-control" name="user" id="user">
                        <option selected disabled>Selecionar Usuario</option>
                        @foreach ($users as $users)
                            <option value=" {{ $users->id }} "> {{ $users->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label> Roles </label>
                    <select class="form-control" name="role" id="role">
                        <option selected disabled>Selecionar Role</option>
                        @foreach ($roles as $roles)
                            <option value="{{ $roles->name }}"> {{ $roles->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <br>
                    <h4 class="text-center"> Permissões </h4>
                    <br>
                </div>

                <div>
                    <div class="form-group row" id="permissoes">
                        <label id="label" class="col-sm-2 col-form-label"> Projetos </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Vizualizar Projetos" value=""
                                   disabled>
                            <label class="form-check-label">Vizualizar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Criar Projetos" value="" disabled>
                            <label class="form-check-label">Cadastrar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Editar Projetos" value="" disabled>
                            <label class="form-check-label">Editar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Deletar Projetos" value="" disabled>
                            <label class="form-check-label">Deletar</label>
                        </div>
                    </div>

                    <div class="form-group row" id="permissoes">
                        <label id="label" class="col-sm-2 col-form-label"> Demandas </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Vizualizar Demandas" value=""
                                   disabled>
                            <label class="form-check-label">Vizualizar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Criar Demandas" value="" disabled>
                            <label class="form-check-label">Cadastrar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Editar Demandas" value="" disabled>
                            <label class="form-check-label">Editar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="Deletar Demandas" value="" disabled>
                            <label class="form-check-label">Deletar</label>
                        </div>
                    </div>
                </div>
                <div id="inputs"></div>

                <div>

                    <input class="btn btn-default" type="submit" value="Editar" id="editaPermission">

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">

        jQuery(document).ready(function () {

            var token = '{{csrf_token()}}';

            $(document).on('blur', '#user', function () {


                $.ajax({

                    url: " {{ route('roles') }} ",
                    dataType: 'json',
                    data: {

                        _token: token,
                        user: $('#user').val(),

                    },
                    type: 'post',
                    success: function (data) {

                        var array = document.getElementsByClassName("form-check-input");

                        var dados = data.roles + "";

                        $("#role").val(dados);

                        $(".form-check-input").prop('checked', false);
                        $('#inputs').empty();

                        for (i = 0; i < array.length; i++) {

                            for (j = 0; j < data.permissions.length; j++) {


                                if (data.permissions[j].name === array[i].name) {

                                    $("[name='" + data.permissions[j].name + "']").prop('checked', true);
                                    $("[name='" + data.permissions[j].name + "']").val(data.permissions[j].name);
                                    $("#inputs").append('<input type="hidden" name = "permissoes[]" value = "' + data.permissions[j].name + '">');

                                }

                            }

                        }

                    },

                    // complete: function(data){

                    //     console.log(data);

                    // }

                });

            });

            $(document).on('blur', '#role', function () {

                $.ajax({

                    url: " {{ route('roles') }} ",
                    dataType: 'json',
                    data: {

                        _token: token,
                        role: $('#role').val(),

                    },
                    type: 'post',
                    success: function (data) {

                        var array = document.getElementsByClassName("form-check-input");

                        $(".form-check-input").prop('checked', false);
                        $('#inputs').empty();


                        for (i = 0; i < array.length; i++) {

                            for (j = 0; j < data.permissionsRoles.length; j++) {

                                if (data.permissionsRoles[j].name === array[i].name) {

                                    $("[name='" + data.permissionsRoles[j].name + "']").prop('checked', true, 'enabled', true);
                                    $("[name='" + data.permissionsRoles[j].name + "']").val(data.permissionsRoles[j].name);
                                    $("#inputs").append('<input type="hidden" name = "permissoes[]" value = "' + data.permissionsRoles[j].name + '">');


                                }

                            }

                        }

                    },

                    // complete: function(data){

                    //     console.log(data);

                    // }

                });

            });

        });

    </script>

@endsection
