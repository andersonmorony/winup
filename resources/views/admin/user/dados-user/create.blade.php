@extends('layouts.criacaoPerfil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body center">
                        Dados Pessoais
                    </div>
                </div>
                <!-- Formulario -->
                 <form method="POST" action="{{ url('finalizando-cadastro') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <br />
                            <br />

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                           

                                @include ('admin.user.dados-user.form')

                          

                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                             @include ('admin.user.endereco-user.form')
                        </div>
                    </div>
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
                <!-- Fim Formulario -->
            </div>
        </div>
    </div>
@endsection
