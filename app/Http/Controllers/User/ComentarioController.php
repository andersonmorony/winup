<?php

namespace winUp\Http\Controllers\User;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;
use winUp\Comentario;
use Illuminate\Http\Request;
use Auth;

class ComentarioController extends Controller
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
            $comentario = Comentario::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('post_id', 'LIKE', "%$keyword%")
                ->orWhere('comentario', 'LIKE', "%$keyword%")
                ->orWhere('imagemPost', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $comentario = Comentario::paginate($perPage);
        }

        return view('usuario.comentario.index', compact('comentario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('usuario.comentario.create');
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

       $cadastroComentario = Comentario::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'comentario' => $request->comentario
        ]);

       if($cadastroComentario)
       {
         return response()->json('Foi');
       }
       else
       {
         return response()->json('Erro');

       }


        return redirect('comentario')->with('flash_message', 'Comentario added!');
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
        $comentario = Comentario::findOrFail($id);

        return view('usuario.comentario.show', compact('comentario'));
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
        $comentario = Comentario::findOrFail($id);

        return view('usuario.comentario.edit', compact('comentario'));
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
        
        $requestData = $request->all();
        
        $comentario = Comentario::findOrFail($id);
        $comentario->update($requestData);

        return redirect('comentario')->with('flash_message', 'Comentario updated!');
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
        Comentario::destroy($id);

        return redirect('comentario')->with('flash_message', 'Comentario deleted!');
    }
}
