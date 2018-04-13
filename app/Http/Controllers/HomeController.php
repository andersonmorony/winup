<?php

namespace winUp\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use winUp\post;
use winUp\seguir;
use winUp\curtir;
use winUp\notificacaoCurtida;
use winUp\comentario;
use winUp\DadosUser;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meu_id = Auth::user()->id;


        $seguindo = seguir::where('user_id', $meu_id)
                    ->get();
        //dd($seguindo);

        $array = array();
        $i = 0;
        $sql = '';

        foreach ($seguindo as $key) {
            $array[$i] = $key->user_id_seguido;
            $i++;
        }

        
        $sql = implode( ' or posts.user_id =',$array );

       

        if($sql)
        {
            $post = DB::select('select posts.*, users.*, posts.id as post_id, posts.created_at as dataCriacao, dados_users.foto_perfil from posts left join users on (users.id = posts.user_id) left join dados_users on (posts.user_id = dados_users.user_id) where posts.user_id = '.$sql.' or posts.user_id ='.$meu_id.' order by dataCriacao desc');
        }
        else
        {
            $post = DB::select('select posts.*, users.*, posts.id as post_id, posts.created_at as dataCriacao, dadosusers.foto_perfil from posts left join users on (users.id = posts.user_id) left join dadosusers on (posts.user_id = dadosusers.user_id) where posts.user_id ='.$meu_id.' order by dataCriacao desc');
        }
        
        foreach ($post as $key) {

            $curtida = curtir::where('post_id', $key->post_id)->get();
            $qtd_curtida = count($curtida);

            $comentario = Comentario::where('post_id', $key->post_id)->get();

          
            if($comentario)
            {
                $qtd = 0;
                foreach ($comentario as $item) {

                    $key->cometarios[$qtd] = $item->comentario;
                    $qtd++;
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

        $foto = DadosUser::select('foto_perfil')
        ->where('user_id', $meu_id)
        ->first();

        //dd($foto);

        //dd($post);

        // $notificacao = notificacaoCurtida::select('notificacao_curtidas.*','curtirs.user_id as usuario_que_curtiu','curtirs.post_id as post_curtido', 'posts.id as id_do_post', 'posts.user_id as usuario_dono_do_post', 'posts.post', 'users.name')
        //                 ->leftjoin('curtirs','curtirs.id', 'curtida_id')
        //                 ->leftjoin('posts','posts.id','post_id')
        //                 ->leftjoin('users','users.id','curtirs.user_id')
        //                 ->where('posts.user_id', $meu_id)
        //                 ->where('notificacao_curtidas.notificacao_visualizada', 0)
        //                 ->orderBy('notificacao_curtidas.created_at', 'desc')
        //                 ->get();
        // $qtd_notificacao = count($notificacao);

        //dd($post);

        return view('home', compact('post','foto'));
    }
}
