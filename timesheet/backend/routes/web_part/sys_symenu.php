<?php
Route::group(['namespace' => 'Sys', 'middleware' => ['web', 'auth']], function () {
	Route::resource('/sys_symenu', 'SymenuController');
	Route::get('/sys_symenu_list', 'SymenuController@getList');
	Route::get('/sys_symenu_lookup', 'SymenuController@getLookup');
	Route::get('/sys_symenu_autocomplete_parent', 'SymenuController@getAutocompleteParent');
});