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

$router->group(['prefix' => '/', 'middleware' => 'auth'], function ($router){

	$router->group( [ 'prefix' => 'kredit' ], function($router){
		$router->get( '/check',[
			'as' 	=> 'kredit.check', 
			'uses' 	=> 'Owner\KreditController@check'
		]);

		$router->get( '/',[
			'as' 	=> 'kredit.index', 
			'uses' 	=> 'Owner\KreditController@getIndex'
		]);
	});

	$router->group( [ 'prefix' => 'uacl' ], function($router){

    	$router->group( [ 'prefix' => 'user' ], function($router){	
			$router->get( '/create', [
				'as' 	=> 'uacl.user.create',
				'uses'	=> 'UACL\UserController@getCreate'
			]);

			$router->post( '/create', [
				'as' 	=> 'uacl.user.create.post',
				'uses'	=> 'UACL\UserController@postCreate'
			]);

			$router->get( '/update/{id}', [
				'as' 	=> 'uacl.user.update',
				'uses'	=> 'UACL\UserController@getUpdate'
			]);

			$router->post( '/update/{id}', [
				'as' 	=> 'uacl.user.update.post',
				'uses'	=> 'UACL\UserController@postUpdate'
			]);

			$router->get( '/delete/{id}', [
				'as' 	=> 'uacl.user.delete',
				'uses'	=> 'UACL\UserController@getDelete'
			]);

			$router->get( '/delete-post/{id}', [
				'as' 	=> 'uacl.user.delete.post',
				'uses'	=> 'UACL\UserController@doDelete'
			]);

			$router->get( '/', [
				'as' 	=> 'uacl.user.index',
				'uses'	=> 'UACL\UserController@getIndex'
			]);
		});

		$router->group( [ 'prefix' => 'usergroup' ], function($router){	
			$router->get( '/access/{id}', [
				'as' 	=> 'uacl.group.access',
				'uses'	=> 'UACL\GroupController@getAccess'
			]);

			$router->post( '/access/{id}', [
				'as' 	=> 'uacl.group.access.post',
				'uses'	=> 'UACL\GroupController@postAccess'
			]);

			$router->get( '/create', [
				'as' 	=> 'uacl.group.create',
				'uses'	=> 'UACL\GroupController@getCreate'
			]);

			$router->post( '/create', [
				'as' 	=> 'uacl.group.create.post',
				'uses'	=> 'UACL\GroupController@postCreate'
			]);

			$router->get( '/update/{id}', [
				'as' 	=> 'uacl.group.update',
				'uses'	=> 'UACL\GroupController@getUpdate'
			]);

			$router->post( '/update/{id}', [
				'as' 	=> 'uacl.group.update.post',
				'uses'	=> 'UACL\GroupController@postUpdate'
			]);

			$router->get( '/delete/{id}', [
				'as' 	=> 'uacl.group.delete',
				'uses'	=> 'UACL\GroupController@getDelete'
			]);

			$router->get( '/delete-post/{id}', [
				'as' 	=> 'uacl.group.delete.post',
				'uses'	=> 'UACL\GroupController@doDelete'
			]);

			$router->get( '/', [
				'as' 	=> 'uacl.group.index',
				'uses'	=> 'UACL\GroupController@getIndex'
			]);
		});
	});

	$router->group( [ 'prefix' => 'service' ], function($router){

		$router->get( '/manager',[
			'as' 	=> 'service.index', 
			'uses' 	=> 'Owner\ServiceController@getIndex'
		]);

		$router->post( '/add',[
			'as' 	=> 'service.add', 
			'uses' 	=> 'Owner\ServiceController@postCreate'
		]);

		$router->post( '/update/{service_id}',[
			'as' 	=> 'service.update', 
			'uses' 	=> 'Owner\ServiceController@postUpdate'
		]);

		$router->post( '/delete/{service_id}',[
			'as' 	=> 'service.delete', 
			'uses' 	=> 'Owner\ServiceController@doSoftDelete'
		]);

		$router->get( '/restore/{service_id}',[
			'as' 	=> 'service.restore', 
			'uses' 	=> 'Owner\ServiceController@doRestore'
		]);
	});

	$router->group( [ 'prefix' => 'product' ], function($router){
		$router->group( [ 'prefix' => 'history' ], function($router){
			$router->get( '/delete/{history_id}',[
				'as' 	=> 'history.delete', 
				'uses' 	=> 'Owner\CafeController@deleteHistory'
			]);

			$router->get( '/clear/{item_id}',[
				'as' 	=> 'history.clear', 
				'uses' 	=> 'Owner\CafeController@clearHistory'
			]);
		});

		$router->get( '/stock',[
			'as' 	=> 'product.stock', 
			'uses' 	=> 'Owner\CafeController@getStock'
		]);

		$router->post( '/add-stock',[
			'as' 	=> 'product.add', 
			'uses' 	=> 'Owner\CafeController@addStock'
		]);

		$router->post( '/update/{item_id}',[
			'as' 	=> 'product.update', 
			'uses' 	=> 'Owner\CafeController@postUpdate'
		]);

		$router->post( '/delete/{item_id}',[
			'as' 	=> 'product.delete', 
			'uses' 	=> 'Owner\CafeController@doSoftDelete'
		]);

		$router->get( '/restore/{item_id}',[
			'as' 	=> 'product.restore', 
			'uses' 	=> 'Owner\CafeController@doRestore'
		]);

		$router->post( '/re-stock',[
			'as' 	=> 'product.restock', 
			'uses' 	=> 'Owner\CafeController@reStock'
		]);

		//ajax stock check
		$router->get( '/check-stock',[
			'as' 	=> 'product.check', 
			'uses' 	=> 'Owner\CafeController@checkStock'
		]);

		$router->get( '/',[
			'as' 	=> 'product.transaction', 
			'uses' 	=> 'Owner\CafeController@getTransaction'
		]);

		$router->post( '/',[
			'as' 	=> 'product.transaction.post', 
			'uses' 	=> 'Owner\CafeController@postTransaction'
		]);
	});

	$router->group( [ 'prefix' => 'cost' ], function($router){
		$router->get( '/',[
			'as' 	=> 'cost.index', 
			'uses' 	=> 'Owner\CostController@getIndex'
		]);

		$router->post( '/create',[
			'as' 	=> 'cost.create', 
			'uses' 	=> 'Owner\CostController@postCreate'
		]);

		$router->post( '/delete/{cost_id}',[
			'as' 	=> 'cost.delete', 
			'uses' 	=> 'Owner\CostController@doDelete'
		]);
	});

	$router->group( [ 'prefix' => 'laporan' ], function($router){
		$router->get( 'detail',[
			'as' 	=> 'laporan.detail', 
			'uses' 	=> 'Owner\LaporanController@getDetail'
		]);

		$router->get( '/{date?}',[
			'as' 	=> 'laporan.index', 
			'uses' 	=> 'Owner\LaporanController@getIndex'
		]);
	});

	$router->get( '/print',[
		'as' 	=> 'print', 
		'uses' 	=> 'Owner\CafeController@getPrint'
	]);

	$router->get( '/',[
		'as' 	=> 'system.index', 
		'uses' 	=> 'DashboardController@getIndex'
	]);
});

$router->controllers([
 	'auth' => 'Auth\AuthController',
 	'password' => 'Auth\PasswordController',
]);

//Register New Member
// $router->post( '/register', [
// 	'as' 	=> 'register.post',
// 	'uses'	=> 'UACL\UserController@postRegister'
// ]);