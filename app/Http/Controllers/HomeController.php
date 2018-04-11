<?php

namespace winUp\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use winUp\post;
use winUp\seguir;
use winUp\curtir;
use winUp\notificacaoCurtida;
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
            $post = DB::select('select posts.*, users.*, posts.id as post_id, posts.created_at as dataCriacao from posts left join users on (users.id = posts.user_id) where posts.user_id = '.$sql.' or posts.user_id ='.$meu_id.' order by dataCriacao desc');
        }
        else
        {
            $post = DB::select('select posts.*, users.*, posts.id as post_id, posts.created_at as dataCriacao from posts left join users on (users.id = posts.user_id) where posts.user_id ='.$meu_id.' order by dataCriacao desc');
        }
        
        foreach ($post as $key) {

            $curtida = curtir::where('post_id', $key->post_id)->get();
            $qtd_curtida = count($curtida);

          

            
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

        // $notificacao = notificacaoCurtida::select('notificacao_curtidas.*','curtirs.user_id as usuario_que_curtiu','curtirs.post_id as post_curtido', 'posts.id as id_do_post', 'posts.user_id as usuario_dono_do_post', 'posts.post', 'users.name')
        //                 ->leftjoin('curtirs','curtirs.id', 'curtida_id')
        //                 ->leftjoin('posts','posts.id','post_id')
        //                 ->leftjoin('users','users.id','curtirs.user_id')
        //                 ->where('posts.user_id', $meu_id)
        //                 ->where('notificacao_curtidas.notificacao_visualizada', 0)
        //                 ->orderBy('notificacao_curtidas.created_at', 'desc')
        //                 ->get();
        // $qtd_notificacao = count($notificacao);

        //dd($notificacao);

        return view('home', compact('post'));
    }
}
