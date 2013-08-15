<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

//http://localhost/crud_laravel/public/crud/show
Route::get('crud/show', 'CrudController@index');
//http://localhost/crud_laravel/public/crud/create para ver formulario crear post
Route::get('crud/create', 'CrudController@create');
//http://localhost/crud_laravel/public/crud/update/id para ver el formulario actualizar
Route::get('crud/update/{id}', 'CrudController@update');
//http://localhost/crud_laravel/public/crud/delete/id para eliminar post
Route::get('crud/delete/{id}', 'CrudController@delete');

//grupo de rutas que aceptan peticiones post, protegemos de ataques csrf
Route::group(array('before' => 'csrf'), function()
{

    //http://localhost/crud_laravel/public/crud/show para crear post
	Route::post('crud/create', 'CrudController@create');
	//http://localhost/crud_laravel/public/crud/update/id para actualizar el post
	Route::post('crud/update/{id}', 'CrudController@update');

});
