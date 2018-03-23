<?php

namespace winUp\Http\Controllers\User;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;

use winUp\DadosUser;
use winUp\User;
use winUp\EnderecoUser;
use Illuminate\Http\Request;
use Auth;

class DadosUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $usuario_on = Auth::user()->id;

        //dd($usuario_on);

        $dadosuser = DadosUser::select('dados_users.*', 'users.name', 'users.email')
        ->leftjoin('users','users.id', 'dados_users.user_id')
        ->where('dados_users.user_id', $usuario_on)
        ->first();
        
        
        return view('usuario.perfil.show', compact('dadosuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.user.dados-user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'datanascimento' => 'required',
			'sexo' => 'required',
			'telefone' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'user_id' => 'required'
		]);
        
        $requestData = $request->all();
        
       
        DadosUser::create($requestData);
        EnderecoUser::create($requestData);


        return redirect('admin/home')->with('flash_message', 'DadosUser added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $dadosuser = DadosUser::select('dados_users.*', 'users.name', 'users.email')
        ->leftjoin('users','users.id', 'dados_users.user_id')
        ->where('dados_users.id', $id)
        ->first();

        return view('admin.user.dados-user.show', compact('dadosuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $usuario_on = Auth::user()->id;

        $dadosuser = DadosUser::select('dados_users.*', 'endereco_users.*', 'endereco_users.id as id_endereco', 'users.name', 'users.email')
        ->leftjoin('endereco_users','endereco_users.user_id','dados_users.user_id')
        ->leftjoin('users','users.id', 'dados_users.user_id')
        ->where('dados_users.user_id', $usuario_on)->first();

        $enderecouser = $dadosuser;
        return view('usuario.perfil.edit', compact('dadosuser', 'enderecouser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $usuario_on = Auth::user()->id;

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
			'datanascimento' => 'required',
			'sexo' => 'required',
			'telefone' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'uf' => 'required'
		]);

        //dd($request);

         $idDados = DadosUser::select('endereco_users.id as id_endereco', 'users.id as id_user')
        ->leftjoin('endereco_users','endereco_users.user_id','dados_users.user_id')
        ->leftjoin('users','users.id', 'dados_users.user_id')
        ->where('dados_users.user_id', $usuario_on)
        ->first();

        $requestData = $request->all(); 

        $dadosuser = DadosUser::where('user_id', $usuario_on);

        $id_users = User::findOrFail($idDados->id_user);

        $enderecouser = EnderecoUser::findOrFail($idDados->id_endereco);
        
        
        $id_users->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $dadosuser->update([
            'datanascimento' => $request->datanascimento,
            'sexo' => $request->sexo,
            'telefone' => $request->telefone
        ]);

        $enderecouser->update([
            'cep' => $request->cep,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf
        ]);

        return redirect('editar/meu-perfil')->with('flash_message', 'Dados atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        DadosUser::destroy($id);

        return redirect('admin/user/dados-user')->with('flash_message', 'DadosUser deleted!');
    }


    public function senha()
    {
        $usuario_on = Auth::user()->id;
        
        return view('usuario.perfil.mudarSenha');
    }

    public function alterSenha(Request $request)
    {
        $usuario_on = Auth::user()->id;


        $id_users = User::findOrFail($usuario_on);

        if (Hash::check("param1", "param2")) {
             //add logic here
            }

        
        $id_users->update([
            'password' => bcrypt($data['novaSenha'])
        ]);
        
        return view('usuario.perfil.mudarSenha');
    }
}
