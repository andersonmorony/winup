<?php

namespace winUp\Http\Controllers\User;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;

use winUp\DadosUser;
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
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $dadosuser = DadosUser::where('datanascimento', 'LIKE', "%$keyword%")
                ->orWhere('sexo', 'LIKE', "%$keyword%")
                ->orWhere('telefone', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $dadosuser = DadosUser::paginate($perPage);
        }

        return view('usuario.dados-user.index', compact('dadosuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        return view('usuario.dados-user.create', compact('user'));
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


        return redirect('User/home')->with('flash_message', 'DadosUser added!');
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
        $dadosuser = DadosUser::findOrFail($id);

        return view('usuario.dados-user.show', compact('dadosuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $dadosuser = DadosUser::findOrFail($id);

        return view('usuario.dados-user.edit', compact('dadosuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'datanascimento' => 'required',
			'sexo' => 'required',
			'telefone' => 'required',
			'user_id' => 'required'
		]);
        $requestData = $request->all();
        
        $dadosuser = DadosUser::findOrFail($id);
        $dadosuser->update($requestData);

        return redirect('User/dados-user')->with('flash_message', 'DadosUser updated!');
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

        return redirect('User/dados-user')->with('flash_message', 'DadosUser deleted!');
    }
}
