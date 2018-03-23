@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="badge">{{ $qtd_encontrados }}</span>
                    @if( $qtd_encontrados > 1)
                        <span> Perfis Encontrados</span>
                    @else
                        <span> Perfil Encontrado</span>
                    @endif
                </div>

                <div class="panel-body" style="padding: 5px;">
                    <ul class="list-group">                    
                    @foreach($usuarios as $item)
                        <li class="list-group-item">
                            <img src="https://png.icons8.com/ios/40/000000/cat-profile.png"> {{ $item->name }}

                            @if($item->user_id != Auth::user()->id)
                                <form class="pull-right" method="POST" action="{{ url('seguir/seguir') }}">   
                                 {{ csrf_field() }}

                                    <div class="btn-group" role="group" aria-label="...">
                                      <button type="button" class="btn btn-default btn-sm">Ver perfil</button>

                                        <button class="btn btn-default btn-sm ">                                    
                                            <span class="">
                                                <img src="https://png.icons8.com/office/17/000000/add-user-male.png">
                                                Seguir
                                                <input type="hidden"  name="id_friend" value="{{ $item->id }}">
                                            </span>
                                        </button>                                  
                                    </div>

                                    
                                </form> 
                            @else
                                 <form class="pull-right" method="POST" action="{{ url('/seguir/seguir' . '/' . $item->seguir_id) }}">   
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                     <div class="btn-group" role="group" aria-label="...">
                                      <button type="button" class="btn btn-default btn-sm">Ver perfil</button>

                                        <button class="btn btn-default btn-sm ">                                    
                                            <span class="">
                                                <img src="https://png.icons8.com/office/17/000000/cancel-2.png">
                                                Deixar de seguir
                                                <input type="hidden"  name="id_friend" value="{{ $item->id }}">
                                            </span>
                                        </button>                                  
                                    </div>

                                </form>
                            @endif
                            <span class="clearfix"></span>
                        </li>
                    @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
