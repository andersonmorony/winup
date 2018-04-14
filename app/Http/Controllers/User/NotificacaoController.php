<?php

namespace winUp\Http\Controllers\User;

use Illuminate\Http\Request;
use winUp\Http\Controllers\Controller;
use Auth;
use winUp\post;
use winUp\seguir;
use winUp\curtir;
use winUp\notificacaoCurtida;
use winUp\Comentario;
use DB;

class NotificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name, $id)
    {

        

        $meu_id = Auth::user()->id;


        $seguindo = seguir::where('user_id', $meu_id)
                    ->get();
       
            $post = DB::select('select posts.*, users.*, posts.id as post_id, posts.created_at as dataCriacao, dados_users.foto_perfil from posts left join users on (users.id = posts.user_id) left join dados_users on (posts.user_id = dados_users.user_id) where posts.id = '.$id);
        
        foreach ($post as $key) {

            $curtida = curtir::where('post_id', $key->post_id)->get();
            $qtd_curtida = count($curtida);

          
           $comentario = Comentario::select('comentarios.*','dados_users.foto_perfil','users.name')
            ->where('post_id', $key->post_id)
            ->leftjoin('dados_users','dados_users.user_id','comentarios.user_id')
            ->leftjoin('users','users.id', 'dados_users.user_id')
            ->get();

            if($comentario)
            {
                $qtd = 0;
                foreach ($comentario as $item) {

                    $key->cometarios[$qtd] = $item->comentario;
                    $key->fotoDeQuemComentou[$qtd] = $item->foto_perfil;
                    $key->dataDoComentario[$qtd] = $item->updated_at;
                    $key->nomeDoAutorDoComentario[$qtd] = $item->name;
                    $qtd++;;
                }
                $key->qtdComentario = $qtd;
            }
            
            if($curtida)
            {
                $qtd = 0;
                foreach ($curtida as $item) {

                    $key->usuario_curtiu[$qtd] = $item->user_id;
                    $qtd++;
                }
            }

            $key->curtida = $qtd_curtida;
        }

        //dd($post);
        return view('usuario.notificacao.index', compact('post', 'comentario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
