<?php

namespace winUp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use winUp\Http\Controllers\Controller;
use winUp\EnderecoUser;

class EnderecoUserController extends Controller
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
            $enderecouser = EnderecoUser::where('cep', 'LIKE', "%$keyword%")
                ->orWhere('rua', 'LIKE', "%$keyword%")
                ->orWhere('numero', 'LIKE', "%$keyword%")
                ->orWhere('complemento', 'LIKE', "%$keyword%")
                ->orWhere('bairro', 'LIKE', "%$keyword%")
                ->orWhere('cidade', 'LIKE', "%$keyword%")
                ->orWhere('uf', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $enderecouser = EnderecoUser::paginate($perPage);
        }

        return view('usuario.endereco-user.index', compact('enderecouser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('usuario.endereco-user.create');
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
            'rua' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'user_id' => 'required'
        ]);
        $requestData = $request->all();
        
        EnderecoUser::create($requestData);

        return redirect('User/endereco-user')->with('flash_message', 'EnderecoUser added!');
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
        $enderecouser = EnderecoUser::findOrFail($id);

        return view('usuario.endereco-user.show', compact('enderecouser'));
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
        $enderecouser = EnderecoUser::findOrFail($id);

        return view('usuario.endereco-user.edit', compact('enderecouser'));
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
            'rua' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'user_id' => 'required'
        ]);
        $requestData = $request->all();
        
        $enderecouser = EnderecoUser::findOrFail($id);
        $enderecouser->update($requestData);

        return redirect('User/endereco-user')->with('flash_message', 'EnderecoUser updated!');
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
        EnderecoUser::destroy($id);

        return redirect('User/endereco-user')->with('flash_message', 'EnderecoUser deleted!');
    }
}
