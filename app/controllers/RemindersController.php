<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::to(URL::route('login') . '#forgot')->with('flash_error', 'E-mail inválido')->withInput();

			case Password::REMINDER_SENT:
				return Redirect::to(URL::route('login') . '#forgot')->with('flash_notice', 'Enviamos um e-mail com as informações para a troca de senha');
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return Redirect::back()->with('flash_error', 'Senhas não coencidem')->withInput();
			case Password::INVALID_TOKEN:
				return Redirect::back()->with('flash_error', 'Token inválido')->withInput();
			case Password::INVALID_USER:
				return Redirect::back()->with('flash_error', 'Email não corresponde com o token')->withInput();

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}

}
