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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/finalizando-cadastro', 'user\\DadosUserController@create')->name('finalizando');


Route::resource('User/dados-user', 'User\\DadosUserController');
Route::resource('User/endereco-user', 'User\\EnderecoUserController');