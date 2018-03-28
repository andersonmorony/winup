<?php

namespace winUp\Http\Controllers\User;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;

use winUp\Curtir;
use Illuminate\Http\Request;
use winUp\post;
use winUp\notificacaoCurtida;
use Auth;

class CurtirController extends Controller
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
            $curtir = Curtir::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('post_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $curtir = Curtir::paginate($perPage);
        }

        return view('usuario.curtir.index', compact('curtir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('usuario.curtir.create');
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
     
        $usuario_on = Auth::user()->id; 

        $post = post::where('user_id', $request->user_id)
                ->where('id', $request->post_id)
                ->first();

        $result = Curtir::create([
            'user_id' => $usuario_on,
            'post_id' => $post->id
        ]);


        if($result)
        {
            $curtida_id_max = Curtir::max('id');

            notificacaoCurtida::create([

                'curtida_id' => $curtida_id_max,
                'notificacao_visualizada' => 0

            ]);

            return response()->json('foi');
        }
        else
        {
             return response()->json($post->id);
        }

        die();
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
        $curtir = Curtir::findOrFail($id);

        return view('usuario.curtir.show', compact('curtir'));
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
        $curtir = Curtir::findOrFail($id);

        return view('usuario.curtir.edit', compact('curtir'));
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
        
        $curtir = Curtir::findOrFail($id);
        $curtir->update($requestData);

        return redirect('curtir/curtir')->with('flash_message', 'Curtir updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $usuario_on = Auth::user()->id; 

        $post = post::where('user_id', $request->user_id)
                ->where('id', $request->post_id)
                ->first();

        $curtir_id = curtir::where('post_id',$post->id)
                    ->where('user_id', $usuario_on)
                    ->first();



       $result =  Curtir::destroy($curtir_id->id);

        if($result)
        {
             return response()->json($post->id);
        }
        else
        {
             return response()->json($post->post);
        }

        //return redirect('curtir/curtir')->with('flash_message', 'Curtir deleted!');
    }
}
