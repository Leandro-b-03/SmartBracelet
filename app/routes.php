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
Route::post('general/company', 'GeneralController@company');
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

Route::post('payments/return/bcash', 'PaymentsController@callBackBcash');
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

    // Start Products
    Route::resource('products', 'ProductsController');
    // End Products

    // Start Products
    Route::resource('bracelets', 'BraceletsController');
    // End Products
});