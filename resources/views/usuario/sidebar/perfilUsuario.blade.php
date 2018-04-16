@php

use winUp\DadosUser;

$usuario_on = Auth::user()->id;
$dadosuser = DadosUser::select('dados_users.*', 'users.name', 'users.email')
        ->leftjoin('users','users.id', 'dados_users.user_id')
        ->where('dados_users.user_id', $usuario_on)
        ->first();

@endphp

<div class="col-md-3">

    <div class="panel panel-default panel-border">
        <div class="panel-heading">Meu Dados</div>
        <div class="panel-body">                      
            <div class="table-responsive">
                <table class="table" style="font-size: 11px ">
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
                     <a href="{{ url('/editar/meu-perfil') }}" class="btn btn-default btn-block">
                        <img src="https://png.icons8.com/color/30/000000/edit.png"> Alterar dados
                    </a>
            </div>
        </div>
    </div>

    <div class="panel panel-default panel-border">
        <div class="panel-heading center">
            Fucionalidades
        </div>

        <div class="panel-body" style="font-size: 11px">
            <ul class="nav" role="tablist">                              
                <li role="presentation">
                    <a href="{{ url('editar/minha-senha') }}">
                        <img src="https://png.icons8.com/color/20/000000/lock.png"> Mudar senha
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
