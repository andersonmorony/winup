@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('usuario.sidebar.perfilUsuario')

            <div class="col-md-9">
                <div class="panel panel-default panel-border">
                    <div class="panel-heading">Meu perfil</div>
                    <div class="panel-body">                      
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Nome</th><td>{{ $dadosuser->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th><td>{{ $dadosuser->email }}</td>
                                    </tr>
                                    <tr>
                                        <th> Data nascimento </th><td> {{ date("d/m/Y", strtotime($dadosuser->datanascimento)) }} </td>
                                    </tr>
                                    <tr>
                                        <th> Sexo </th><td> {{ $dadosuser->sexo == 0 ? 'Masculino' : 'Feminino' }} </td>
                                    </tr>
                                    <tr>
                                        <th> Telefone </th><td> {{ $dadosuser->telefone }} </td>
                                    </tr>
                                    <tr>
                                        <th> Data Criação </th><td> {{ date("d/m/Y", strtotime($dadosuser->created_at)) }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

