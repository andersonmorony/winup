<?php

namespace winUp\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use winUp\post;
use winUp\seguir;
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
            $post = DB::select('select posts.*, users.*, posts.created_at as dataCriacao from posts left join users on (users.id = posts.user_id) where posts.user_id = '.$sql.' or posts.user_id ='.$meu_id.' order by dataCriacao desc');
        }
        else
        {
            $post = DB::select('select posts.*, users.*, posts.created_at as dataCriacao from posts left join users on (users.id = posts.user_id) where posts.user_id ='.$meu_id.' order by dataCriacao desc');
        }
        


       //dd($post);

        return view('home', compact('post'));
    }
}
