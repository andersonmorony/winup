@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('usuario.sidebar.perfilUsuario')

            <div class="col-md-8">

               @if (session('flash_message'))

                    <div class="alert alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button><strong>Mensagem</strong>
                      <br><small>{{ session('flash_message') }}</small>
                    </div>

                @endif 
                <!-- Formulario -->
                <form method="POST" action="{{ url('/editar/minha-senha') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                    <div class="panel panel-default panel-border">
                        <div class="panel-heading">
                            Alterar Senha
                        </div>
                        <div class="panel-body">

                           <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                <label for="name" class="col-md-4 control-label">{{ 'Senha Atual' }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="password" id="password" required="" placeholder="Senha Atual">        
                                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('novaSenha') ? 'has-error' : ''}}">
                                <label for="novaSenha" class="col-md-4 control-label">{{ 'Nova Senha' }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="novaSenha" id="novaSenha" required="" placeholder="Nova senha">        
                                        {!! $errors->first('novaSenha', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Botão de enviar -->
                    <div class="panel panel-default col-md-offset-4  col-md-4 center">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input class="btn  btn-block btn-primary" type="submit" value="{{ $submitButtonText or 'Salvar' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Fim formulario -->
            </div>
        </div>
    </div>
@endsection
@push('panel-border-top-color')
    <style type="text/css">
        .panel-border
            {
                border-top-color: red !important;
                border-top-width: 3px;
            }
    </style>
@endpush