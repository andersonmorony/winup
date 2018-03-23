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
                    <div class="panel panel-default">
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
                        </div>
                        <div class="panel-footer">
                            <div>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                      <div class="btn-group" role="group">
                                        <a href="{{ url('/admin/user/dados-user') }}" type="button" class="btn btn-default"><img src="https://png.icons8.com/small/17/000000/facebook-like.png">
                                            Curtir
                                        </a>
                                      </div>
                                      <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default"><img src="https://png.icons8.com/windows/17/000000/comments.png">
                                         Comentar
                                        </button>
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
