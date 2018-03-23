<?php

namespace winUp\Http\Controllers\User;

use Illuminate\Http\Request;
use winUp\Http\Controllers\Controller;
use winUp\user;
use winUp\Seguir;
use Auth;
use DB;

class EncontrarAmigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qtd = 0;
        $usuario_on = Auth::user()->id;

        $usuarios = DB::select('select users.*, seguirs.user_id, seguirs.user_id_seguido, seguirs.id as seguir_id from users left join seguirs on (seguirs.user_id_seguido = users.id and seguirs.user_id = '.$usuario_on.') where name like "%'.$request->search_fiends.'%" and role = 1 and users.id <> '.$usuario_on);       

        //dd($usuarios);

        $qtd_encontrados = count($usuarios);

        return view('usuario.encontrar.encontrarAmigos', compact('usuarios', 'qtd_encontrados'));
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
