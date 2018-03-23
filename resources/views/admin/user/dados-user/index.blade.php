@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">

            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dados Usuários
                    </div>
                    <div class="panel-body">


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Id</th><th>Data nascimento</th><th>Sexo</th><th>Telefone</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($dadosuser as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ date("d/m/Y", strtotime($item->datanascimento)) }}</td>
                                        <td>{{ $item->sexo == 0 ? 'Masculino' : 'Feminino' }}</td>
                                        <td>{{ $item->telefone }}</td>
                                        <td>
                                            <a href="{{ url('admin/user/dados-user/' . $item->id) }}" title="View DadosUser"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</button></a>
                                            <a href="{{ url('admin/user/dados-user/' . $item->id . '/edit') }}" title="Edit DadosUser"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('admin/user/dados-user' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete DadosUser" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Bloquear </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_datatable')
    <script src="{{ asset('js\dataTable.js') }}"></script>
@endpush