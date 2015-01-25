<?php

class RemindersWebController extends Controller {

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
		Log::info('RemindersController::postRemind', array(Input::all()));
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::to('success')->with('message', 'Una e-mail con tutti i dettagli per creare una nuova password è stata inviata!');
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
		Log::info('RemindersController::getReset', array('token'=>$token));
		if (is_null($token)) 
			App::abort(404);
		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		Log::info('RemindersController::postReset', array(Input::all()));
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
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));
			case Password::PASSWORD_RESET:
				return Redirect::to('success')->with('message', 'La nuova password è stata impostata! Effettua il login.');
		}
	}
}