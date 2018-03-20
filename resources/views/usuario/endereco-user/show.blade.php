@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">EnderecoUser {{ $enderecouser->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/User/endereco-user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/User/endereco-user/' . $enderecouser->id . '/edit') }}" title="Edit EnderecoUser"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('User/enderecouser' . '/' . $enderecouser->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete EnderecoUser" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $enderecouser->id }}</td>
                                    </tr>
                                    <tr><th> Cep </th><td> {{ $enderecouser->cep }} </td></tr><tr><th> Rua </th><td> {{ $enderecouser->rua }} </td></tr><tr><th> Numero </th><td> {{ $enderecouser->numero }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
