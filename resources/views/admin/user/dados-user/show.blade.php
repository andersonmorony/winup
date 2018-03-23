@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Dados Usuário Nº {{ $dadosuser->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/user/dados-user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('admin/user/dados-user/' . $dadosuser->id . '/edit') }}" title="Edit DadosUser"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/user/dadosuser' . '/' . $dadosuser->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete DadosUser" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Bloquear</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $dadosuser->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nome</th><td>{{ $dadosuser->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th><td>{{ $dadosuser->email }}</td>
                                    </tr>
                                    <tr>
                                        <th> Datanascimento </th><td> {{ date("d/m/Y", strtotime($dadosuser->datanascimento)) }} </td>
                                    </tr>
                                    <tr>
                                        <th> Sexo </th><td> {{ $dadosuser->sexo == 0 ? 'Masculino' : 'Feminino' }} </td>
                                    </tr>
                                    <tr>
                                        <th> Telefone </th><td> {{ $dadosuser->telefone }} </td>
                                    </tr>
                                    <tr>
                                        <th> Data Criação </th><td> {{ date("d/m/Y h:i:s", strtotime($dadosuser->created_at)) }} </td>
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
