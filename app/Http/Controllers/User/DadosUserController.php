<?php

namespace winUp\Http\Controllers\User;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use winUp\DadosUser;
use winUp\User;
use winUp\EnderecoUser;
use winUp\Comentario;
use winUp\curtir;
use winUp\notificacaoCurtida;
use Auth;
use DB;



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

        $post = DB::select('select posts.*, users.*, posts.id as post_id, posts.created_at as dataCriacao, dados_users.foto_perfil from posts left join users on (users.id = posts.user_id) left join dados_users on (posts.user_id = dados_users.user_id) where posts.user_id = '.$usuario_on.' order by dataCriacao desc' );
        
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

        return view('usuario.perfil.show', compact('dadosuser','post'));
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
    public function edit(Request $request)
    {
        $usuario_on = Auth::user()->id;

        $dadosuser = DadosUser::select('dados_users.*', 'endereco_users.*', 'endereco_users.id as id_endereco', 'users.name', 'users.email')
        ->leftjoin('endereco_users','endereco_users.user_id','dados_users.user_id')
        ->leftjoin('users','users.id', 'dados_users.user_id')
        ->where('dados_users.user_id', $usuario_on)
        ->first();        

        $enderecouser = $dadosuser;

        //dd($dadosuser);

        return view('usuario.perfil.edit', compact('dadosuser', 'enderecouser'));
    }

     public function fileUpload($request)
    {
        $id_producao = $request->get('producao');
        $file = $request->file('foto');
        $nome_arquivo = '';

        if($file = $request->file('foto'))
        {
            $i = 0;
            $_UP['extensoes'] = array('jpg','JPG', 'PNG', 'png', 'jpeg','JPEG');

            $extension = $file->getClientOriginalExtension();

          
            if (array_search($extension, $_UP['extensoes']) === false) 
            {
                echo "Por favor, envie arquivos com as seguintes extensões: jpg, png, jpeg, gif ou pdf";
                exit;
            }
            $nome_final = md5(time()).'.jpg';

            
            Storage::disk('ImagemPerfil')->put($nome_final,  File::get($file));
            $nome_arquivo = $nome_final;
        }

      

        
        return $nome_arquivo;
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
        

        $valor = $this->fileUpload($request);

        //dd($valor);

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

        if($valor)
        {
            $dadosuser->update([                
                'foto_perfil' => $valor,
                'datanascimento' => $request->datanascimento,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone
            ]);  
        }
        else
        {            
            $dadosuser->update([
                'datanascimento' => $request->datanascimento,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone
            ]);
        }

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
