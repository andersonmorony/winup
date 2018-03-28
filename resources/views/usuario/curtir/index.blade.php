@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Curtir</div>
                    <div class="card-body">
                        <a href="{{ url('/curtir/curtir/create') }}" class="btn btn-success btn-sm" title="Add New Curtir">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar novo
                        </a>

                        <form method="GET" action="{{ url('/curtir/curtir') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>User Id</th><th>Post Id</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($curtir as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->user_id }}</td><td>{{ $item->post_id }}</td>
                                        <td>
                                            <a href="{{ url('/curtir/curtir/' . $item->id) }}" title="View Curtir"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</button></a>
                                            <a href="{{ url('/curtir/curtir/' . $item->id . '/edit') }}" title="Edit Curtir"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/curtir/curtir' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Curtir" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $curtir->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
