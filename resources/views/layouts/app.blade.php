<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/dataTables.js') }}" defer></script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"> --}}

    <style>

        #form input, select{

            margin-bottom:  10px;

        }

        #label {

            padding-top: 0px;

        }

        .form-check-inline {

            padding-right: 10px;
            padding-left: 10px;

        }

    </style>

<script type="text/javascript">

    jQuery(document).ready(function(){

        var token = '{{csrf_token()}}';

        $('#notifications').focusout(function() {

            $.ajax({

                url: "{{ route('notifications') }}",
                type: 'POST',
                data: {
                    _token: token,
                },
                dataType: 'json',

                success: function(data) {

                    console.log(data);

                },

                complete: function(data){
                    console.log(data);

                }


            });

        });

    });


</script>

    @yield('scripts')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest

                        @else

                            <li class="nav-item">
                                <div class="dropdown">
                                    @if (count(auth::user()->unreadNotifications) !== 0)
                                        <button class="nav-link btn" type="button" data-toggle="dropdown" id="notifications">
                                            <img id="icon" src=" {{ asset('img/bell-fill.svg') }} " title="Bootstrap">
                                        </button>
                                        <div class="dropdown-menu"  aria-labelledby="dropdownMenuButton">
                                            @foreach (auth::user()->unreadNotifications as $item)

                                                <a href=" {{ route('listaDemandas') }} " class="dropdown-item" value = "{{ $item->data['message'] }}"> {{ $item->data['message'] }} </a>

                                            @endforeach
                                        </div>
                                    @else
                                        <button class="nav-link btn" type="button" data-toggle="dropdown" >
                                            <img src=" {{ asset('img/bell.svg') }} " title="Bootstrap">
                                        </button>
                                    @endif

                                </div>
                            </li>

                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listaDemandas') }}">{{ __('Demandas') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('importJob') }}">{{ __('Importar') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('listaProjetos') }}">{{ __('Projetos') }}</a>
                            </li>
                            @hasrole('Admin')
                                <li>
                                    <a class="nav-link" href="{{ route('editPermissions') }}">{{ __('Permissões') }}</a>
                                </li>
                            @endhasrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
{{--                                    {{ Auth::user()->name }} <span class="caret"></span>--}}
                                    @if(Auth::user()->image)
                                        <img src=" {{ asset('storage/' .Auth::user()->image) }} " title="Bootstrap" width="30" height="30">
                                    @else
                                        <img src=" {{ asset('img/person.svg') }} " title="Bootstrap">
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=" {{ route('listProfile') }} ">

                                        Edit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
