<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('winup');
});

Auth::routes();

// Middleware apenas para quem ta logado
Route::group(['middleware' => 'auth'], function () {
		Route::group(['middleware' => 'DadosObrigatorios'], function () {
			//Middleware apenas para com role 1, Administrador
			Route::group(['middleware' => 'role:1'], function () {
				
				Route::get('/home', 'HomeController@index')->name('home');
				Route::resource('/meu-perfil', 'User\\DadosUserController');
				Route::get('/editar/meu-perfil', 'User\\DadosUserController@edit');
				Route::PATCH('/editar/meu-perfil', 'User\\DadosUserController@update');
				Route::get('/editar/minha-senha', 'User\\DadosUserController@senha');
				Route::PATCH('/editar/minha-senha', 'User\\DadosUserController@alterSenha');
				Route::POST('/search/pessoas', 'User\\EncontrarAmigosController@index');				
				Route::get('/curtir', 'user\\CurtirController@store');
				Route::get('/curtirDelete', 'user\\CurtirController@destroy');
				Route::get('notificacao/{name?}/post/{id?}', 'User\\NotificacaoController@index');
				Route::resource('post/posts', 'User\\PostsController');
				Route::resource('seguir/seguir', 'User\\SeguirController');
				Route::resource('curtir/curtir', 'User\\CurtirController');
			});

			Route::group(['prefix'=>'admin', 'middleware' => 'role:2'], function () {
				
				//Pagina Home
				Route::get('/home', 'Admin\\HomeController@index')->name('home');
				//Pagina para adicionar Roles
				Route::resource('user/roles', 'Admin\\RolesController');
				Route::resource('user/dados-user', 'Admin\\DadosUserController');
				//Route::resource('user/endereco-user', 'Admin\\EnderecoUserController');
				Route::resource('tipo-notificacao', 'Admin\\TipoNotificacaoController');
				Route::resource('notificacao-curtida', 'Admin\\notificacaoCurtidaController');

			});
			//Fim Middleware apenas para com role 1, Administrador
		});
	// Fim Middleware apenas para quem ta logado
	Route::get('/finalizando-cadastro', 'user\\DadosUserController@create')->name('finalizando');
	Route::post('/finalizando-cadastro', 'user\\DadosUserController@store')->name('finalizando');
});




Route::resource('comentario', 'User\\ComentarioController');
//Comentar post via Ajax
Route::get('/comentar/post', 'User\\ComentarioController@store');


 Route::get('/images/{image}', function($image = null)
    {
        $path = storage_path().'/app/imagemPerfil/' . $image;
        if (file_exists($path)) { 
            return response()->file($path);
        }
    });