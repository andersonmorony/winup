<?php

namespace winUp\Http\Controllers\Admin;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;

use winUp\TipoNotificacao;
use Illuminate\Http\Request;

class TipoNotificacaoController extends Controller
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
            $tiponotificacao = TipoNotificacao::where('titulo', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $tiponotificacao = TipoNotificacao::paginate($perPage);
        }

        return view('admin.tipo-notificacao.index', compact('tiponotificacao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tipo-notificacao.create');
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
			'titulo' => 'required'
		]);
        $requestData = $request->all();
        
        TipoNotificacao::create($requestData);

        return redirect('tipo-notificacao')->with('flash_message', 'TipoNotificacao added!');
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
        $tiponotificacao = TipoNotificacao::findOrFail($id);

        return view('admin.tipo-notificacao.show', compact('tiponotificacao'));
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
        $tiponotificacao = TipoNotificacao::findOrFail($id);

        return view('admin.tipo-notificacao.edit', compact('tiponotificacao'));
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
			'titulo' => 'required'
		]);
        $requestData = $request->all();
        
        $tiponotificacao = TipoNotificacao::findOrFail($id);
        $tiponotificacao->update($requestData);

        return redirect('tipo-notificacao')->with('flash_message', 'TipoNotificacao updated!');
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
        TipoNotificacao::destroy($id);

        return redirect('tipo-notificacao')->with('flash_message', 'TipoNotificacao deleted!');
    }
}
