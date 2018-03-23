<?php

namespace winUp\Http\Controllers\User;

use winUp\Http\Requests;
use winUp\Http\Controllers\Controller;

use winUp\Post;
use Illuminate\Http\Request;
use Auth;

class PostsController extends Controller
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
            $posts = Post::where('post', 'LIKE', "%$keyword%")
                ->orWhere('imagem', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $posts = Post::paginate($perPage);
        }

        return view('usuario.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('usuario.posts.create');
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
			'post' => 'required'
		]);
        

        $usuario_on = Auth::user()->id;

        Post::create([
            'post' => $request->post,
            'user_id' => $usuario_on
        ]);

        return redirect('/home')->with('flash_message', 'Post added!');
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
        $post = Post::findOrFail($id);

        return view('usuario.posts.show', compact('post'));
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
        $post = Post::findOrFail($id);

        return view('usuario.posts.edit', compact('post'));
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
			'post' => 'required',
			'imagem' => 'required',
			'video' => 'required',
			'user_id' => 'required'
		]);
        $requestData = $request->all();
        
        $post = Post::findOrFail($id);
        $post->update($requestData);

        return redirect('post/posts')->with('flash_message', 'Post updated!');
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
        Post::destroy($id);

        return redirect('post/posts')->with('flash_message', 'Post deleted!');
    }
}
