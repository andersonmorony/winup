@php

use winUp\post;
use winUp\seguir;
use winUp\curtir;
use winUp\notificacaoCurtida;

$notificacao = notificacaoCurtida::select('notificacao_curtidas.*','curtirs.user_id as usuario_que_curtiu','curtirs.post_id as post_curtido', 'posts.id as id_do_post', 'posts.user_id as usuario_dono_do_post', 'posts.post', 'users.name')
                        ->leftjoin('curtirs','curtirs.id', 'curtida_id')
                        ->leftjoin('posts','posts.id','post_id')
                        ->leftjoin('users','users.id','curtirs.user_id')
                        ->where('posts.user_id', Auth::user()->id)
                        ->where('notificacao_curtidas.notificacao_visualizada', 0)
                        ->orderBy('notificacao_curtidas.created_at', 'desc')
                        ->get();
$qtd_notificacao = count($notificacao);

$meu_nome = Auth::user()->name;

@endphp


</!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WinUP') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style type="text/css">
        body{
            background-color: #fafafa !important;
        }
        .containerPrincipal
        {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <img src="{{ asset('img\logo100.png') }}" class="img-responsive">
                        </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                         <form class="navbar-form navbar-left" action="{{ url('search\pessoas') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                             <input type="text" name="search_fiends" id="search_fiends" class="form-control" placeholder="Pesquisar">
                            </div>
                            <button type="submit" class="btn btn-default">
                                <img src="https://png.icons8.com/ios-glyphs/20/000000/search.png">
                            </button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Busca -->
                       
                        <!-- Busca -->

                        <!-- Authentication Links -->
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <img src="https://png.icons8.com/ios-glyphs/18/000000/alarm.png">
                                    <span class="badge">{{ $qtd_notificacao }} </span>
                                        Notificação 
                                    <span class="caret"></span>
                                </a>

                                
                               
                                <div class="dropdown-menu list-group">
                                    @foreach($notificacao as $item)
                                        @if($item)

                                         <a href='{{ url("notificacao/$meu_nome/post/$item->id_do_post") }}' class="list-group-item">
                                            <small>
                                                <img src="https://png.icons8.com/color/17/000000/filled-star.png">
                                                @if($item->usuario_que_curtiu != Auth::user()->id)
                                                    {{$item->name}} Curtiu sua publicação.
                                                @else
                                                    Você Curtiu sua publicação.
                                                @endif
                                                 @if(date("d/m/Y", strtotime(NOW())) == date("d/m/Y", strtotime($item->created_at)))
                                                    <span class="pull-right">agora</span>
                                                 @else
                                                    <span class="pull-right">{{ date("d/m/Y", strtotime($item->created_at)) }}</span>
                                                 @endif
                                                 
                                            </small>
                                         </a>
                                         @else
                                         <a href="#" class="list-group-item">
                                            <span>sem Notificação</span>
                                        </a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                

                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/meu-perfil') }}">Meu Perfil</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/post.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    @stack('panel-border-top-color')
</body>
</html>
