@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">notificacaoCurtida {{ $notificacaocurtida->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/notificacao-curtida') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/notificacao-curtida/' . $notificacaocurtida->id . '/edit') }}" title="Edit notificacaoCurtida"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('notificacaocurtida' . '/' . $notificacaocurtida->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete notificacaoCurtida" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $notificacaocurtida->id }}</td>
                                    </tr>
                                    <tr><th> Curtida Id </th><td> {{ $notificacaocurtida->curtida_id }} </td></tr><tr><th> Notificacao Visualizada </th><td> {{ $notificacaocurtida->notificacao_visualizada }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
