@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Criar publicação</div>

                <div class="panel-body" style="padding: 5px;">
                    <form method="POST" id="criarPost" action="{{ url('/post/posts') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
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
                        <div class="panel-body" style="padding: 5px 10px;">
                                 <div class="col-md-12">
                                    <div class="testimonials">
                                        <div class="active item">
                                            <div class="carousel-info">
                                            @if($item->foto_perfil)                                
                                                <img src="/images/{{$item->foto_perfil}}" width="40" class="img-responsive media-object pull-left">
                                            @else
                                                <img src="https://png.icons8.com/ios/40/000000/cat-profile.png" class="pull-left">
                                            @endif
                                            <div class="pull-left">
                                              <span class="testimonials-name">{{ $item->name }}</span>
                                              @if(date("d/m/Y", strtotime(now())) != date("d/m/Y", strtotime($item->dataCriacao)))
                                                 <span class="testimonials-post">{{  date("d/m/Y", strtotime($item->dataCriacao)) }}</span>
                                              @else
                                                 <span class="testimonials-post">{{  date("h:s", strtotime($item->dataCriacao)) }}</span>
                                              @endif
                                            </div>
                                          </div>
                                          <br>
                                          <blockquote><p>{{ $item->post }}</p></blockquote>                                         
                                        </div>
                                    </div>
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
                            @for($i = 0; $i < $item->qtdComentario; $i++ )
                            <div class="panel-body" style="padding: 5px 10px;">
                                 <div class="col-md-12">
                                    <div class="testimonials">
                                        <div class="active item">
                                          
                                          <div class="carousel-info">
                                            @if($item->fotoDeQuemComentou[$i])                                
                                                <img src="/images/{{$item->fotoDeQuemComentou[$i]}}" width="40" class="pull-left">
                                            @else
                                                <img src="https://png.icons8.com/ios/40/000000/cat-profile.png" class="pull-left">
                                            @endif
                                            <div class="pull-left">
                                              <span class="testimonials-name">{{$item->nomeDoAutorDoComentario[$i]}}</span>
                                                @if(date("d/m/Y", strtotime(now())) != date("d/m/Y", strtotime($item->dataDoComentario[$i])))
                                                     <span class="testimonials-post">{{  date("d/m/Y", strtotime($item->dataDoComentario[$i])) }}</span>
                                                @else
                                                 <span class="testimonials-post">{{  date("G:s A", strtotime($item->dataDoComentario[$i])) }}</span>
                                                @endif
                                            </div>
                                          </div>
                                          <blockquote class="post-comentario"><p>{{$item->cometarios[$i]}}</p></blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            @endfor
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
