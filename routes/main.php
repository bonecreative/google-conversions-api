<?php
Route::group(['as' => 'analytics::', 'prefix' => 'public-api', 'namespace' => '\\BoneCreative\\GoogleConversionsApi', 'middleware' => ['cors', 'api']], function ()
{
	
	Route::match(['options', 'post'], 'analytics/g', [
		'as'   => 'g',
		'uses' => 'Controller'
	]);
});