@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Criar publicação</div>

                <div class="panel-body" style="padding: 5px;">
                    <form method="POST" action="{{ url('/post/posts') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12">                            
                            <div class="form-group">
                                <textarea rows="4" name="post" type="textarea" id="post" required class="form-control" placeholder="Em que você estar pensando, {{ Auth::user()->name }} ?"></textarea>                            
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary pull-right">Publicar</button>
                        
                    </form>
                </div>
            </div>

               @if (session('flash_message'))

                    <div class="alert alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button><strong>Mensagem</strong>
                      <br><small>{{ session('flash_message') }}</small>
                    </div>

                @endif 
            @if($post)

                @foreach($post as $item)
                    <div class="panel panel-default panel-post">
                        <div class="panel-body">
                            <div>
                                <img src="https://png.icons8.com/ios/40/000000/cat-profile.png">
                                <span>{{ $item->name }}</span>
                                <small>{{  date("d/m/Y h:s:i", strtotime($item->dataCriacao)) }}</small>
                            </div>
                            <br>
                            <div>
                                <p>{{ $item->post }}</p>                            
                            </div> 
                            <div>
                                @if($item->curtida > 0)
                                    <img src="https://png.icons8.com/color/20/000000/filled-star.png">
                                    <span class="badge"> {{ $item->curtida }} </span>
                                @endif
                            </div>                       
                        </div>
                        <div class="panel-footer">
                            <div>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">

                                    <!-- Verifica se o post tem curtida -->
                                    @if($item->curtida > 0)
                                        @php
                                            $qtd = 0;
                                        @endphp
                                        <!-- verifica se quem curtiu o post é o usuario logado -->
                                        @foreach($item->usuario_curtiu as $key)
                                            

                                            @if($key == Auth::user()->id)                                            

                                                @php
                                                    $qtd++;
                                                @endphp

                                            @endif
                                        @endforeach

                                        @if($qtd > 0)
                                            <div class="btn-group" role="group" >
                                                <button  type="button" class="btn btn-primary btn_curtido" id="btn-curtir{{$item->post_id.$item->user_id}}_curtido"><img src="https://png.icons8.com/color/17/000000/filled-star.png">
                                                         Curtido
                                                </button>                                                
                                                <button  type="button" style="display: none;" class="btn btn-default btn_curtir" id="btn-curtir{{$item->post_id.$item->user_id}}"><img src="https://png.icons8.com/color/17/000000/filled-star.png">
                                                     Curtir
                                                </button>
                                            </div>
                                        @else
                                            <div class="btn-group" role="group" >
                                                <button  type="button" class="btn btn-default btn_curtir" id="btn-curtir{{$item->post_id.$item->user_id}}"><img src="https://png.icons8.com/color/17/000000/filled-star.png">
                                                     Curtir
                                                </button>
                                                <button  style="display: none;" type="button" class="btn btn-primary btn_curtido" id="btn-curtir{{$item->post_id.$item->user_id}}_curtido"><img src="https://png.icons8.com/color/17/000000/filled-star.png">
                                                    Curtido
                                                </button>
                                              </div>

                                        @endif

                                    @else
                                      <div class="btn-group" role="group" >
                                        <button  type="button" class="btn btn-default btn_curtir" id="btn-curtir{{$item->post_id.$item->user_id}}"><img src="https://png.icons8.com/color/17/000000/filled-star.png">
                                             Curtir
                                        </button>
                                        <button  style="display: none;" type="button" class="btn btn-primary btn_curtido" id="btn-curtir{{$item->post_id.$item->user_id}}_curtido"><img src="https://png.icons8.com/color/17/000000/filled-star.png">
                                            Curtido
                                        </button>
                                      </div>
                                    @endif
                                      <div class="btn-group" role="group">
                                        <a href="#comentar" type="button" class="btn btn-default"><img src="https://png.icons8.com/windows/17/000000/comments.png">
                                         Comentar
                                        </a>
                                      </div>
                                      <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default"><img src="https://png.icons8.com/small/17/000000/share.png">
                                            Compartilhar
                                        </button>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default panel-comment">
                       @if($item->qtdComentario > 0)
                            @foreach($item->cometarios as $comentario)
                            <div class="panel-body">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="col-md-1">
                                        <img src="https://png.icons8.com/ios/40/000000/cat-profile.png">
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{$comentario}}</p>
                                        <span class="badge">
                                            Curtir
                                        </span>
                                    </div>                                
                                  </div>
                                </div>
                            </div>  
                            @endforeach
                        @endif                      
                        <div class="panel-footer">
                            <div class="input-group input-group">               
                                <input type="text"  class="form-control" id="{{$item->post_id.$item->user_id}}" placeholder="Comentar" aria-describedby="sizing-addon1">
                                <span class="input-group-addon" id="sizing-addon1">
                                    <img src="https://png.icons8.com/ios/17/000000/screenshot.png">
                                </span>
                                <span class="input-group-btn">
                                    <button type="button" data-post="{{$item->post_id}}" data-input="{{$item->post_id.$item->user_id}}" class="btn btn-primary enviar-comentario" type="button">Enviar</button>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button><strong>Mensagem</strong>
                  <br><small>Você ainda não publicou nada <img src="https://png.icons8.com/office/20/000000/crying.png">, <br> publique algo novo ou faça novas amizades!</small><br>
                  <label for="search_fiends">Click aqui e pesquise novos amigos</label>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
