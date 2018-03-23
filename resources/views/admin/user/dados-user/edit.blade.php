@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

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
                <form method="POST" action="{{ url('admin/user/dados-user/' . $dadosuser->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                    <div class="panel panel-default">
                        <div class="panel-heading">Editar Perfil</div>
                        <div class="panel-body">
                            <a href="{{ url('admin/user/dados-user') }}" title="Back"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                            <br />
                            <br />

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @include ('admin.user.dados-user.formUser', ['submitButtonText' => 'Update'])
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            

                            

                                @include ('admin.user.dados-user.form', ['submitButtonText' => 'Update'])

                            

                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            @include ('admin.user.endereco-user.form', ['submitButtonText' => 'Update'])
                            
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
