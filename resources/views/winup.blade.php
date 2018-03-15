<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
<div class="container containerPrincipal">
    <div class="row">
        <div class="col-md-6" >
            <img src="img/paul-larkin-501616-unsplash.jpg" class="img-responsive">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">                    
                    <div class="panel-heading center">
                        <h1>Win Up</h1>
                        <p>Cadastre-se para ver fotos e videos de seus amigos</p>                    
                    </div>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label" >Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" placeholder="Digite seu nome" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Digite seu email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" placeholder="Digite sua senha" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confimar Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Confirme sua senha" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Cadastrar-se
                                </button>
                                <br>
                                <p class="center">
                                    Ao cadastrar-se, você concorda com nossos Termos e Política de Privacidade.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body center">
                    <p>Tem uma conta? <a href="{{ route('login') }}">faça login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
