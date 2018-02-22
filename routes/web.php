<?php

$this->group(['middleware' => ['auth', 'auth.unique.user']], function(){
    // Rotas autenticadas
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
        ->name('home')
        ->middleware('auth.unique.user');
