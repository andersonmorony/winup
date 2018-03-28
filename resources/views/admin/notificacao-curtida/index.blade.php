@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Notificacaocurtida</div>
                    <div class="card-body">
                        <a href="{{ url('/notificacao-curtida/create') }}" class="btn btn-success btn-sm" title="Add New notificacaoCurtida">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar novo
                        </a>

                        <form method="GET" action="{{ url('/notificacao-curtida') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Curtida Id</th><th>Notificacao Visualizada</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($notificacaocurtida as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->curtida_id }}</td><td>{{ $item->notificacao_visualizada }}</td>
                                        <td>
                                            <a href="{{ url('/notificacao-curtida/' . $item->id) }}" title="View notificacaoCurtida"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</button></a>
                                            <a href="{{ url('/notificacao-curtida/' . $item->id . '/edit') }}" title="Edit notificacaoCurtida"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/notificacao-curtida' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete notificacaoCurtida" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $notificacaocurtida->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
