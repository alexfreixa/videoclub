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

/*API*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@getHome');//->name('principal'); //Carreguem el controlador i el mètode associat


Route::group(['middleware' => 'auth'], function() {

    //Rutes GET
    
    Route::get('/catalog/show/{id}', 'CatalogController@getShow');
    Route::get('/catalog/create', 'CatalogController@getCreate');
    Route::get('/catalog/edit/{id}', 'CatalogController@getEdit');
    Route::get('/catalog', 'CatalogController@getIndex');

    //Route::get('/catalog/vote/{id}/{rate}', 'CatalogController@putVote')->name('voting');
    Route::any('/catalog/vote/{id}/{rate}', 'CatalogController@putVote')->name('voting');

    //Rutes POST
    Route::post('/catalog/create', 'CatalogController@postCreate');

    //Rutes PUT
    Route::put('/catalog/edit/{id}', 'CatalogController@putEdit');
    Route::put('/catalog/rent/{id}', 'CatalogController@putRent');
    Route::put('/catalog/return/{id}', 'CatalogController@putReturn');
    //Route::put('/catalog/vote/{id}/{rate}', 'CatalogController@putVote')->name('shop.order.test');
    
    //Rutes DELETE
    Route::delete('/catalog/delete/{id}', 'CatalogController@deleteMovie');

});

/*
//->name('nom); <<<---- metode per posar noms a rutes
//PER EXEMPLE: Route::get('/catalog/edit/{id}', 'CatalogController@getEdit')->name('editar');
*/

