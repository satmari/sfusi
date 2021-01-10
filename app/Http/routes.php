<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('/', 'HomeController@index');

//SfusiAdd
Route::get('add', 'SfusiAddController@index');
Route::post('searchinteos', 'SfusiAddController@searchinteos');
Route::post('checkqty', 'SfusiAddController@checkqty');
Route::post('add_new_box', 'SfusiAddController@add_new_box');
Route::get('move', 'SfusiAddController@move');
Route::post('move_box', 'SfusiAddController@move_box');
Route::post('move_to_location/{id}', 'SfusiAddController@move_to_location');

//Sfusi Table
Route::get('table', 'SfusiTableController@index');
Route::get('table2', 'SfusiTableController@index2');
Route::get('table/edit/{id}', 'SfusiTableController@edit');
Route::post('table/edit_update/{id}', 'SfusiTableController@edit_update');
// Route::get('table/remove/{id}', 'SfusiTableController@remove');
Route::get('table/remove/{id}', 'SfusiTableController@remove_ship');

//Ship Table
Route::get('table_s', 'ShipTableController@index');
Route::get('remove_ship_table', 'ShipTableController@remove');
Route::get('table_s/remove/{id}', 'ShipTableController@remove_ship');

//SfusiSearch
Route::get('search', 'SfusiSearchController@index');

// Refresh 
Route::get('refresh', 'SfusiTableController@refresh');
Route::get('refresh_tpp', 'SfusiTableController@refresh_tpp');

// Export 
Route::get('export', 'ExportController@index');

//SfusiRemove
// Route::get('remove', 'SfusiRemoveController@index');
Route::get('removecb', 'SfusiRemoveController@index');
Route::get('removecb/destroy', 'SfusiRemoveController@destroy');
Route::post('removecb/destroy', 'SfusiRemoveController@destroy');
Route::get('removecb/destroycb', 'SfusiRemoveController@destroycb');
// Route::post('removecb/destroycb', 'SfusiRemoveController@destroycb');
Route::post('removecb/destroycb', 'SfusiRemoveController@destroycb2');

// addlog
Route::get('addlogtable', 'adlogTableControler@index');
Route::get('clearlogtable', 'adlogTableControler@clearlogtable');
Route::get('deletelogtable', 'adlogTableControler@deletelogtable');
Route::post('deletelogtableconfirm', 'adlogTableControler@deletelogtableconfirm');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
