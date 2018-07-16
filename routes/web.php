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


Route::group([
    'prefix'=>'code',
    'namespace'=>'Code'
], function(){
    Route::get('table', 'TableController@index');
    Route::get('table/{name}', 'TableController@show');
    Route::post('saveTableData', 'TableController@storage');
    Route::post('genModel', 'TableController@genModel');
    Route::post('genRequest', 'TableController@genRequest');
    Route::post('genController', 'TableController@genController');
    Route::post('genStoreModule', 'TableController@genStoreModule');
    Route::post('genListComponents', 'TableController@genListComponents');
    Route::post('genCreateComponent', 'TableController@genCreateComponent');
    Route::post('genEditComponent', 'TableController@genEditComponent');

});
