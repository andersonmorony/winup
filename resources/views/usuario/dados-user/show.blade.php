@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">DadosUser {{ $dadosuser->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/User/dados-user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/User/dados-user/' . $dadosuser->id . '/edit') }}" title="Edit DadosUser"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('User/dadosuser' . '/' . $dadosuser->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete DadosUser" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $dadosuser->id }}</td>
                                    </tr>
                                    <tr><th> Datanascimento </th><td> {{ $dadosuser->datanascimento }} </td></tr><tr><th> Sexo </th><td> {{ $dadosuser->sexo }} </td></tr><tr><th> Telefone </th><td> {{ $dadosuser->telefone }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
