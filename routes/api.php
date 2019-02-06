<?php

use Illuminate\Http\Request;
Use App\Movie;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/catalog', 'APICatalogController@index');
Route::get('/v1/catalog/{id}', 'APICatalogController@show');
Route::post('/v1/catalog', 'APICatalogController@store')->middleware('auth.basic');
Route::put('/v1/catalog/{id}', 'APICatalogController@update')->middleware('auth.basic');
Route::delete('/v1/catalog/{id}', 'APICatalogController@destroy')->middleware('auth.basic');
Route::put('/v1/catalog/{id}/rent', 'APICatalogController@putRent')->middleware('auth.basic');
Route::put('/v1/catalog/{id}/return', 'APICatalogController@putReturn')->middleware('auth.basic');

// Remove-item alias:curl <-- ES CORRECTE UTILITZAR AQUESTA COMANDA PER FER FUNCIONAR cURL?
// curl --user alexfreixa18@gmail.com:alex http://localhost/videoclub/public/api/v1/catalog/21