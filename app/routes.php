<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

// Start Login
Route::get('login', array('as' => 'login', function () {
	return View::make('login.login');
}))->before('guest');
Route::post('login', function () {
	$user = array(
		'username' => Input::get('username'),
		'password' => Input::get('password')
	);

	try {
		if (Auth::attempt($user)) {
			return Redirect::route('home')->with('flash_notice', 'Você foi logado com sucesso.');
		}
	} catch (UserDeletedException $e) {
		echo 'User has been deleted and can not log in.';
	}

	// authentication failure! lets go back to the login page
	return Redirect::route('login')->with('flash_error', 'Usuário e senha não combinam.')->withInput();
});
Route::get('logout', array('as' => 'logout', function () {
	Auth::logout();

	return Redirect::route('login')->with('flash_notice', 'Você foi deslogado com sucesso.');
}))->before('auth');
Route::filter('guest', function () {
	if (Auth::check()) {
		return Redirect::route('home')->with('flash_notice', 'Você já está logado!');
	}
}
);
Route::filter('auth', function () {
	if (Auth::guest()) {
		return Redirect::route('login')->with('flash_error', 'É necessario logar para visualizar esta pagina!');
	}
}
);
Route::post('reminder', 'RemindersController@postRemind');
Route::get('password/reset/{token}', 'RemindersController@getReset');
Route::post('password/reset/{token}', 'RemindersController@postReset');

Route::get('app/login', function () {
	$user = array(
		'username' => Input::get('username'),
		'password' => Input::get('password')
	);

	try {
		if (Auth::attempt($user)) {
			return Response::json(array('return' => true, 'idFuncionario' => Auth::user()->id));
		}
	} catch (UserDeletedException $e) {
		return Response::json(array('return' => false));
	}

	return Response::json(array('return' => false));
}
);
// End Login

// ===============================================
// Manage SECTION ================================
// ===============================================
Route::group(array('before' => 'auth'), function () {

	// Start Home
	Route::get('/', array('as' => 'home', function () {}));
	Route::resource('/', 'HomeController');
	Route::resource('home', 'HomeController');
	// End Home

    // Start MyAccount
    Route::resource('myaccount', 'MyAccountController');
    // End MyAccount

    // Start Users
    Route::resource('users', 'UsersController');
    // End Users

    // Start Products
    Route::resource('products', 'ProductsController');
    // End Products

    // Start Commands
    Route::resource('commands', 'CommandsController');
    // End Commands

    // Start Orders
    Route::resource('orders', 'OrdersController');
    // End Orders

    // Start Orders
    Route::resource('verify_command', 'VerifyCommandController');
    // End Orders
    
    //start custumers 
    Route::resource('customers', 'CustomersController');
    //end custumers 

    //start associate
    Route::get('associate', 'AssociateController@index');
    Route::get('associate/getCustomersByName', 'AssociateController@getCustomersByName');
    //end associate

    // Start Autocomplete
    Route::get('autocomplete/products', 'AutocompleteController@products');
    Route::get('autocomplete/comands', 'AutocompleteController@comands');
    // End Autocomplete

    // Start General
    Route::get('general/getComand', 'GeneralController@getComand');
    // End General
});
