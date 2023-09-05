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

// Example Routes

// NO AUTH ROUTES
Route::get('/commande', ['as' => 'commande', 'uses' => 'CommandeController@commande']);
Route::post('/doCommande', ['as' => 'doCommande', 'uses' => 'CommandeController@doCommande']);
//Route::get('/commande/show/{id}', ['as' => 'commande.show', 'uses' => 'CommandeController@show']);

// AUTH ROUTES 
Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware(['auth']);
Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth']);

// HOME CONTROLLER
Route::get('/contacts', 'HomeController@contacts')->middleware(['auth']);

// USER CONTROLLER

// STOCK CONTROLLER
Route::get('/stock', 'StockController@index')->middleware(['auth']);

// ADMIN ROUTES & CONTROLLER
//Route::get('/admin/commandes', ['as' => 'admin.commandes', 'uses' => 'AdminController@commandes'])->middleware(['admin']);
//Route::get('/admin/commandes/waiting', ['as' => 'admin.commandes_waiting', 'uses' => 'AdminController@commandes_waiting'])->middleware(['admin']);
//Route::get('/admin/commande/edit/{id}', ['as' => 'admin.commande.edit', 'uses' => 'CommandeController@edit'])->middleware(['admin']);
//Route::post('/admin/commande/validate/{id}', ['as' => 'admin.commande.validate', 'uses' => 'CommandeController@accept'])->middleware(['admin']);
//Route::post('/admin/commande/decline/{id}', ['as' => 'admin.commande.decline', 'uses' => 'CommandeController@decline'])->middleware(['admin']);
//Route::delete('/admin/commande/destroy/{id}', ['as' => 'admin.commande.delete', 'uses' => 'CommandeController@delete'])->middleware(['admin']);
Route::put('/admin/commande/{id}', 'CommandeController@update')->name('admin.commande.update')->middleware('admin');
//Route::get('/admin/commande/edit/{id}', 'CommandeController@edit')->name('admin.commande.edit')->middleware('admin');
Route::post('/admin/commande/store', 'CommandeController@store')->name('admin.commande.store')->middleware('auth');
Route::get('/admin/commande/create', 'CommandeController@create')->name('admin.commande.create')->middleware('auth');
Route::get('/commande/show/{id}', 'CommandeController@show')->name('commande.show')->middleware('auth');
Route::post('/admin/commandes/set-makart/{id}', 'CommandeController@setSend')->name('admin.commandes.setMakart');


//Route::get('/admin/commande', 'AdminInventaireController@index')->name('admin.inventaires.index')->middleware('admin');

// -- COMMANDES ROUTES FOR ADMINS --
Route::get('/admin/commandes', 'CommandeController@index')->name('admin.commandes.index')->middleware('admin');
Route::get('/admin/commandes/waiting', 'CommandeController@show_waiting')->name('admin.commandes.show_waiting')->middleware('admin');
Route::get('/admin/commandes/confirmed', 'CommandeController@show_confirmed')->name('admin.commandes.show_confirmed')->middleware('admin');

Route::get('/admin/commandes/edit/{id}', 'CommandeController@edit')->name('admin.commandes.edit')->middleware('admin');
Route::put('/admin/commandes/{id}', 'CommandeController@update')->name('admin.commandes.update')->middleware('admin');
Route::post('/admin/commande/validate/{id}','CommandeController@accept')->name('admin.commandes.validate')->middleware('admin');
Route::delete('/admin/commande/destroy/{id}','CommandeController@destroy')->name('admin.commandes.destroy')->middleware('auth');
Route::post('/admin/commande/decline/{id}','CommandeController@decline')->name('admin.commandes.decline')->middleware('admin');


// -- COMMANDES ROUTES FOR USER --/admin/commandes/waiting
Route::post('/commandes/store', 'CommandeController@store')->name('commandes.store');
Route::get('/commandes/create', 'CommandeController@create')->name('commandes.create');
Route::get('/commandes', 'CommandeController@show_comite')->name('commandes.comite')->middleware('auth');


Route::put('/admin/commandes/{id}', 'CommandeController@update')->name('admin.commandes.update')->middleware('admin');
//Route::delete('/admin/commandes/{id}', 'CommandeController@destroy')->name('admin.commandes.destroy')->middleware('admin');
Route::get('/admin/commandes/{id}/edit', 'CommandeController@edit')->name('admin.commandes.edit')->middleware('admin');

// -- Event ROUTES FOR USER --/admin/commandes/waiting
Route::get('/events', 'EventsController@index')->name('events.index');
Route::get('/events/add', 'EventsController@add')->name('events.add');
Route::post('/events/create', 'EventsController@create')->name('events.create');
Route::get('/events/edit/{id}', 'EventsController@edit')->name('events.edit')->middleware('admin');
Route::post('/events/validate/{id}','EventsController@accept')->name('events.validate')->middleware('admin');
Route::delete('/events/destroy/{id}','EventsController@destroy')->name('events.destroy')->middleware('auth');
Route::post('/events/decline/{id}','EventsController@decline')->name('events.decline')->middleware('admin');
Route::get('/admin/events/waiting', 'EventsController@show_waiting')->name('admin.events.show_waiting')->middleware('admin');

// -- Documents ROUTES FOR USER --/admin/commandes/waiting
Route::get('/documents/index', 'DocumentsController@index')->name('events.index')->middleware('auth');
Route::get('/documents/add', 'DocumentsController@add')->name('documents.add');
Route::post('/documents/upload', 'DocumentsController@upload')->name('documents.upload')->middleware('auth');
Route::post('/documents/update/{id}', 'DocumentsController@update')->name('admin.documents.update')->middleware('auth');
Route::get('/documents/edit/{id}', 'DocumentsController@edit')->name('admin.documents.edit')->middleware('auth');
Route::get('/documents/show/{id}', 'DocumentsController@show')->name('documents.show')->middleware('auth');

Route::get('/documents/download/{id}', 'DocumentsController@download')->name('documents.download')->middleware('auth');

Route::delete('/documents/destroy/{id}', 'DocumentsController@destroy')->name('admin.documents.destroy')->middleware('admin');

// Il peut aussi être utile d'avoir une route pour afficher la liste des documents

Route::get('/admin/events', ['as' => 'admin.events', 'uses' => 'AdminController@events'])->middleware(['admin']);
Route::get('/admin/event/add', ['as' => 'admin.event.add', 'uses' => 'EventsController@add'])->middleware(['admin']);
Route::get('/admin/event/edit/{id}', ['as' => 'admin.event.edit', 'uses' => 'EventsController@edit'])->middleware(['admin']);
Route::post('/admin/event/update/{id}', ['as' => 'admin.event.update', 'uses' => 'EventsController@update'])->middleware(['admin']);
Route::post('/admin/event/delete/{id}', ['as' => 'admin.event.delete', 'uses' => 'EventsController@delete'])->middleware(['admin']);

//Route::post('/event/create', ['as' => 'admin.event.create', 'uses' => 'EventsController@create'])->middleware(['admin']);

Route::get('/admin/materiel', ['as' => 'admin.materiels', 'uses' => 'AdminController@materiels'])->middleware(['admin']);
Route::get('/admin/materiel/add', ['as' => 'admin.materiel.add', 'uses' => 'MaterielsController@add'])->middleware(['admin']);
Route::post('/admin/materiel/create', ['as' => 'admin.materiel.create', 'uses' => 'MaterielsController@create'])->middleware(['admin']);
Route::get('/admin/materiel/edit/{id}', ['as' => 'admin.materiel.edit', 'uses' => 'MaterielsController@edit'])->middleware(['admin']);
Route::post('/admin/materiel/update/{id}', ['as' => 'admin.materiel.update', 'uses' => 'MaterielsController@update'])->middleware(['admin']);

Route::get('/admin/futs', ['as' => 'admin.futs', 'uses' => 'AdminController@futs'])->middleware(['admin']);
Route::get('/admin/fut/add', ['as' => 'admin.fut.add', 'uses' => 'FutsController@add'])->middleware(['admin']);
Route::post('/admin/fut/create', ['as' => 'admin.fut.create', 'uses' => 'FutsController@create'])->middleware(['admin']);
Route::get('/admin/fut/edit/{id}', ['as' => 'admin.fut.edit', 'uses' => 'FutsController@edit'])->middleware(['admin']);
Route::post('/admin/fut/update/{id}', ['as' => 'admin.fut.update', 'uses' => 'FutsController@update'])->middleware(['admin']);

Route::get('/admin/stock/add', ['as' => 'admin.stock.add', 'uses' => 'StockController@add'])->middleware(['admin']);
Route::post('/admin/stock/create', ['as' => 'admin.stock.create', 'uses' => 'StockController@create'])->middleware(['admin']);
Route::get('/admin/stock/edit/{id}', ['as' => 'admin.stock.edit', 'uses' => 'StockController@edit'])->middleware(['admin']);
Route::post('/admin/stock/update/{id}', ['as' => 'admin.stock.update', 'uses' => 'StockController@update'])->middleware(['admin']);
Route::delete('/admin/stock/destroy/{id}', ['as' => 'admin.stock.destroy', 'uses' => 'StockController@destroy'])->middleware(['admin']);

Route::get('/admin/users', ['as' => 'admin.users', 'uses' => 'AdminController@users'])->middleware(['admin']);
Route::get('/admin/user/add', ['as' => 'admin.user.add', 'uses' => 'UserController@add'])->middleware(['admin']);
Route::post('/admin/user/create', ['as' => 'admin.user.create', 'uses' => 'UserController@create'])->middleware(['admin']);
Route::get('/admin/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UserController@edit'])->middleware(['admin']);
Route::post('/admin/user/update/{id}', ['as' => 'admin.user.update', 'uses' => 'UserController@update'])->middleware(['admin']);
// -- FACTURES ROUTES FOR ADMINS --
Route::get('/admin/factures', 'FactureController@index')->name('admin.factures.index')->middleware('admin');
Route::get('/admin/factures/create', 'FactureController@create')->name('admin.factures.create')->middleware('admin');
Route::post('/admin/factures/store', 'FactureController@store')->name('admin.factures.store')->middleware('admin');
Route::get('/admin/factures/edit', 'FactureController@edit')->name('admin.factures.edit')->middleware('admin');
Route::delete('/admin/factures/{id}', 'FactureController@destroy')->name('admin.factures.destroy')->middleware('admin');
Route::get('/factures/{filename}', 'FactureController@getFacture')->name('admin.facture.view')->middleware('admin');
Route::post('/admin/factures/updateIsSend', 'FactureController@updateIsSend');
Route::post('/admin/factures/updatePaid', 'FactureController@updatePaid');

// -- Folder creation
Route::post('/folder/create', 'FolderController@create')->name('admin.folder.create')->middleware('admin');



// -- INVENTAIRE ROUTES FOR ADMINS --
Route::get('/admin/inventaires', 'AdminInventaireController@index')->name('admin.inventaires.index')->middleware('admin');
Route::post('/admin/inventaires/store', 'AdminInventaireController@store')->name('admin.inventaires.store')->middleware('admin');
Route::get('/admin/inventaires/create', 'AdminInventaireController@create')->name('admin.inventaires.create')->middleware('admin');
Route::put('/admin/inventaires/{id}', 'AdminInventaireController@update')->name('admin.inventaires.update')->middleware('admin');
Route::delete('/admin/inventaires/{id}', 'AdminInventaireController@destroy')->name('admin.inventaires.destroy')->middleware('admin');
Route::get('/admin/inventaires/{id}/edit', 'AdminInventaireController@edit')->name('admin.inventaires.edit')->middleware('admin');
Route::get('/admin/inventaires/recap/{id}', 'AdminInventaireController@recap')->name('admin.inventaires.recap')->middleware('admin');
Route::get('/admin/inventaires/comitesortant', 'AdminInventaireController@generatepdfcomitesortant')->name('admin.inventaires.generatepdfcomitesortant')->middleware('admin');
Route::get('/admin/inventaires/comiteentrant', 'AdminInventaireController@generatepdfcomiteentrant')->name('admin.inventaires.generatepdfcomiteentrant')->middleware('admin');
Route::post('/admin/inventaires/upload', 'AdminInventaireController@uploadInventory')->name('admin.inventaires.upload');
Route::post('/admin/inventaires/upload-entrant/{id}', 'AdminInventaireController@uploadInventoryEntrant')->name('admin.inventaires.uploadEntrant');
Route::post('/admin/inventaires/upload-sortant/{id}', 'AdminInventaireController@uploadInventorySortant')->name('admin.inventaires.uploadSortant');
Route::get('/admin/inventaires/upload/{id}', 'AdminInventaireController@uploadPage')->name('admin.inventaires.uploadPage');
Route::get('/admin/inventaires/show/{id}', 'AdminInventaireController@show')->name('inventaires.signed.show')->middleware('auth');


// -- INVENTAIRE ROUTES FOR USERS --
Route::get('/inventaires', 'UserInventaireController@index')->name('user.inventaires.index')->middleware('auth');
Route::put('inventaires/{id}', 'UserInventaireController@update')->name('user.inventaires.update')->middleware('auth');
Route::get('inventaires/{id}/edit', 'UserInventaireController@edit')->name('user.inventaires.edit')->middleware('auth');

// -- LISTING ROUTES FOR ADMINS --
Route::get('/admin/listing', 'AdminListingController@index')->name('admin.listings.index')->middleware('admin');
Route::post('/admin/listing', 'AdminListingController@store')->name('admin.listings.store')->middleware('admin');
Route::get('/admin/listing/create', 'AdminListingController@create')->name('admin.listings.create')->middleware('admin');
Route::get('/admin/listing/{id}', 'AdminListingController@show')->name('admin.listings.show')->middleware('admin');
Route::put('/admin/listing/{id}', 'AdminListingController@update')->name('admin.listings.update')->middleware('admin');
Route::delete('/admin/listing/{id}', 'AdminListingController@destroy')->name('admin.listings.destroy')->middleware('auth');
Route::get('/admin/listing/{id}/edit', 'AdminListingController@edit')->name('admin.listings.edit')->middleware('admin');

// -- LISTING-CB ROUTES FOR USERS --
Route::get('/listing', 'UserListingController@index')->name('listings.index')->middleware('auth');
Route::post('/listing', 'UserListingController@store')->name('listings.store')->middleware('auth');
Route::get('/listing/create', 'UserListingController@create')->name('listings.create')->middleware('auth');
// Route::get('/listing/{id}', 'UserListingController@show')->name('listings.show')->middleware('auth');
Route::put('/listing/{id}', 'UserListingController@update')->name('listings.update')->middleware(['auth', 'comite']);
Route::delete('/listing/{id}', 'UserListingController@destroy')->name('listings.destroy')->middleware('auth', 'comite');
Route::get('/listing/{id}/edit', 'UserListingController@edit')->name('listings.edit')->middleware(['auth', 'comite']);
// -- LISTING PDF
Route::get('/listing/bar', 'pdfController@createpdfbar')->name('admin.listings.generatepdfbar')->middleware('admin');
Route::get('/listing/details', 'pdfController@createpdfdetails')->name('admin.listings.generatepdfdetails')->middleware('admin');
Route::get('/listing/detailscsv', 'AdminListingController@createcsvdetails')->name('admin.listings.generatecsvdetails')->middleware('admin');
// -- PROFILE ROUTES FOR USERS --
Route::put('/profile/{id}', 'ProfileController@update')->name('profile.update')->middleware('auth');
Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('profile.edit')->middleware('auth');

// -- CREATION DE FACTURE
Route::get('/admin/inventaires/facture/{id}', 'AdminInventaireController@createfactureinventaire')->name('admin.inventaires.facture')->middleware('admin');

//Route::get('/commandes/{id}', ['as' => 'commandes.self', 'uses' => 'CommandeController@my_commandes'])->middleware(['auth']);
Route::view('/pages/slick', 'pages.slick')->middleware(['auth']);;
Route::view('/pages/datatables', 'pages.datatables')->middleware(['auth']);;
Route::view('/pages/blank', 'pages.blank')->middleware(['auth']);;

// google calenar
Route::get('/google-authenticate', 'YourController@redirectToGoogle');
Route::get('/google-callback', 'YourController@handleGoogleCallback');

// OLD SITE 

/* Route::resource('commande', 'CommandeController');
Route::get('event', ['as' => 'commande.event', 'uses' => 'PagesController@addEvent']);
Route::post('chooseevent', ['as' => 'commande.choose', 'uses' => 'CommandeController@commandForEvent']);
Route::get('commande/event/{id}', ['as' => 'commande', 'uses' => 'PagesController@commande']);
Route::post('/doCommande', ['as' => 'doCommande', 'uses' => 'CommandeController@doCommande']);
Route::post('/event/create', ['as' => 'admin.event.create', 'uses' => 'EventsController@create']);


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
}); */
