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
                <form method="POST" action="{{ url('/editar/meu-perfil') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                    <div class="panel panel-default panel-border">
                        <div class="panel-heading">Imagem</div>
                        <div class="panel-body" style="">
                            
                            <div class="row">
                              <div class="col-xs-6 col-md-3">
                                <a href="/images/{{$dadosuser->foto_perfil}}" class="thumbnail">
                                    @if($dadosuser->foto_perfil)
                                    <img src="/images/{{$dadosuser->foto_perfil}}">
                                    @else
                                     <img src="https://png.icons8.com/dotty/100/000000/administrator-male.png">
                                    @endif
                                </a>
                              </div>
                              
                            </div>
                            <input type="file" name="foto">
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Editar Perfil</div>
                        <div class="panel-body">
                            

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @include ('usuario.perfil.formUser', ['submitButtonText' => 'Update'])
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            

                            

                                @include ('usuario.perfil.form', ['submitButtonText' => 'Update'])

                            

                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            @include ('usuario.endereco-user.form', ['submitButtonText' => 'Update'])
                            
                        </div>
                    </div>
                    <!-- Botão de enviar -->
                    <div class="panel panel-default col-md-offset-4  col-md-4 center">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input class="btn  btn-block btn-primary" type="submit" value="{{ $submitButtonText or 'Finalizar' }}">
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