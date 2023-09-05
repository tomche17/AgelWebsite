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

Route::get('/', ['as' => 'pages.home', 'uses' => 'PagesController@home']);

Route::resource('commande', 'CommandeController');
Route::get('event', ['as' => 'commande.event', 'uses' => 'PagesController@addEvent']);
Route::post('chooseevent', ['as' => 'commande.choose', 'uses' => 'CommandeController@commandForEvent']);
Route::get('commande/event/{id}', ['as' => 'commande', 'uses' => 'PagesController@commande']);
Route::get('/login', ['as' => 'login', 'uses' => 'PagesController@Login']);
Route::post('/doCommande', ['as' => 'doCommande', 'uses' => 'CommandeController@doCommande']);
Route::post('/event/create', ['as' => 'admin.event.create', 'uses' => 'EventsController@create']);



//Action Users
Route::post('/doLogin', ['as' => 'doLogin', 'uses' => 'UsersController@doLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'UsersController@logout']);

Route::group(array('prefix' => 'admin', 'middleware' => 'auth'), function()
{
    Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@admin']);
    Route::get('/users', ['as' => 'admin.users', 'uses' => 'AdminController@users']);
    Route::get('/user/add', ['as' => 'admin.user.add', 'uses' => 'UsersController@add']);
    Route::post('/user/create', ['as' => 'admin.user.create', 'uses' => 'UsersController@create']);
    Route::get('/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UsersController@edit']);
    Route::post('/user/update/{id}', ['as' => 'admin.user.update', 'uses' => 'UsersController@update']);

    Route::get('/events', ['as' => 'admin.events', 'uses' => 'AdminController@events']);
    Route::get('/event/add', ['as' => 'admin.event.add', 'uses' => 'EventsController@add']);
    Route::get('/event/edit/{id}', ['as' => 'admin.event.edit', 'uses' => 'EventsController@edit']);
    Route::post('/event/update/{id}', ['as' => 'admin.event.update', 'uses' => 'EventsController@update']);
    Route::post('/event/delete/{id}', ['as' => 'admin.event.delete', 'uses' => 'EventsController@delete']);

    Route::get('/materiel', ['as' => 'admin.materiels', 'uses' => 'AdminController@materiels']);
    Route::get('/materiel/add', ['as' => 'admin.materiel.add', 'uses' => 'MaterielsController@add']);
    Route::post('/materiel/create', ['as' => 'admin.materiel.create', 'uses' => 'MaterielsController@create']);
    Route::get('/materiel/edit/{id}', ['as' => 'admin.materiel.edit', 'uses' => 'MaterielsController@edit']);
    Route::post('/materiel/update/{id}', ['as' => 'admin.materiel.update', 'uses' => 'MaterielsController@update']);

    Route::get('/futs', ['as' => 'admin.futs', 'uses' => 'AdminController@futs']);
    Route::get('/fut/add', ['as' => 'admin.fut.add', 'uses' => 'FutsController@add']);
    Route::post('/fut/create', ['as' => 'admin.fut.create', 'uses' => 'FutsController@create']);
    Route::get('/fut/edit/{id}', ['as' => 'admin.fut.edit', 'uses' => 'FutsController@edit']);
    Route::post('/fut/update/{id}', ['as' => 'admin.fut.update', 'uses' => 'FutsController@update']);

    Route::get('/inventaires', ['as' => 'admin.inventaires', 'uses' => 'AdminController@inventaires']);
    Route::get('/inventaire/add', ['as' => 'admin.inventaire.add', 'uses' => 'InventairesController@add']);
    Route::post('/inventaire/create', ['as' => 'admin.inventaire.create', 'uses' => 'InventairesController@create']);
    Route::post('/inventaire/delete/{id}', ['as' => 'admin.inventaire.delete', 'uses' => 'InventairesController@delete']);
    Route::get('/inventaire/edit/{id}', ['as' => 'admin.inventaire.edit', 'uses' => 'InventairesController@edit']);
    Route::post('/inventaire/update/{id}', ['as' => 'admin.inventaire.update', 'uses' => 'InventairesController@update']);

    Route::get('/commandes', ['as' => 'admin.commandes', 'uses' => 'AdminController@commandes']);
    Route::get('/commande/edit/{id}', ['as' => 'admin.commande.edit', 'uses' => 'CommandeController@edit']);
    Route::post('/commande/validate/{id}', ['as' => 'admin.commande.validate', 'uses' => 'CommandeController@accept']);
    Route::post('/commande/decline/{id}', ['as' => 'admin.commande.decline', 'uses' => 'CommandeController@decline']);
    Route::post('/commande/delete/{id}', ['as' => 'admin.commande.delete', 'uses' => 'CommandeController@delete']);
});
