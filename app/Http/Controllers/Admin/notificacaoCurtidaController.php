<?php

namespace winUp\Http\Controllers\Admin;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;

use winUp\notificacaoCurtida;
use Illuminate\Http\Request;

class notificacaoCurtidaController extends Controller
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
            $notificacaocurtida = notificacaoCurtida::where('curtida_id', 'LIKE', "%$keyword%")
                ->orWhere('notificacao_visualizada', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $notificacaocurtida = notificacaoCurtida::paginate($perPage);
        }

        return view('admin.notificacao-curtida.index', compact('notificacaocurtida'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.notificacao-curtida.create');
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
			'notificacao_visualizada' => 'required',
			'curtida_id' => 'required'
		]);
        $requestData = $request->all();
        
        notificacaoCurtida::create($requestData);

        return redirect('notificacao-curtida')->with('flash_message', 'notificacaoCurtida added!');
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
        $notificacaocurtida = notificacaoCurtida::findOrFail($id);

        return view('admin.notificacao-curtida.show', compact('notificacaocurtida'));
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
        $notificacaocurtida = notificacaoCurtida::findOrFail($id);

        return view('admin.notificacao-curtida.edit', compact('notificacaocurtida'));
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
			'notificacao_visualizada' => 'required',
			'curtida_id' => 'required'
		]);
        $requestData = $request->all();
        
        $notificacaocurtida = notificacaoCurtida::findOrFail($id);
        $notificacaocurtida->update($requestData);

        return redirect('notificacao-curtida')->with('flash_message', 'notificacaoCurtida updated!');
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
        notificacaoCurtida::destroy($id);

        return redirect('notificacao-curtida')->with('flash_message', 'notificacaoCurtida deleted!');
    }
}
