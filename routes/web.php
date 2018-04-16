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
    return view('welcome');
});

Route::get('/getChip', 'AccessTypeController@index');

//Route::get('/edit-chip/{id}', 'AccessTypeController@show')->middleware('signedurl');

Route::middleware(['signedurl'])->group(function () {
    Route::get('/edit-chip/{id}', 'AccessTypeController@show');
});

Route::get('/without-signed/{id}', function ($id) {
	return [
		'id'=>$id,
		'signed-url'=>UrlSigner::sign(url('with-signed/'.$id), Carbon\Carbon::now()->addHours(2) )
	];
});

Route::get('/with-signed/{id}', function ($id) {
	return [
		'id'=>$id
	];
})->middleware('signedurl');