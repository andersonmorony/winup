<?php

namespace winUp\Http\Controllers\User;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;

use winUp\Seguir;
use Illuminate\Http\Request;
use Auth;
use winUp\user;

class SeguirController extends Controller
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
            $seguir = Seguir::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id_seguido', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $seguir = Seguir::paginate($perPage);
        }

        return view('usuario.seguir.index', compact('seguir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('usuario.seguir.create');
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
        
        $requestData = $request->all();
        

        $id_user = Auth::user()->id;

        Seguir::create([
            'user_id' => $id_user,
            'user_id_seguido' => $request->id_friend
        ]);

        $seguindo = user::where('id', $request->id_friend)->first();

        return redirect('/home')->with('flash_message', 'Parabéns, Agora você estar seguindo, '.$seguindo->name.'');
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
        $seguir = Seguir::findOrFail($id);

        return view('usuario.seguir.show', compact('seguir'));
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
        $seguir = Seguir::findOrFail($id);

        return view('usuario.seguir.edit', compact('seguir'));
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
        
        $seguir = Seguir::findOrFail($id);
        $seguir->update($requestData);

        return redirect('seguir/seguir')->with('flash_message', 'Seguir updated!');
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


        Seguir::destroy($id);

        $seguindo = user::where('id', $id)->first();

        return redirect('/home')->with('flash_message', 'Vocês não são mais amigos');
    }
}
