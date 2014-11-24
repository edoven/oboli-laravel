<?php


class MailinglistController extends BaseController {


	public function addEmail()
	{
		$rules = array('email' => 'required|email');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) 
			return Redirect::to('/error')->withMessage('L\'indirizzo email inserito non è corretto');
		if (MailinglistEntry::where('email', Input::get('email'))->first() != null)
			return Redirect::to('/success')->withMessage('Grazie per esserti iscritto alla nostra mailing list!');
		$mailingListEntry = new MailinglistEntry;
		$mailingListEntry->email = Input::get('email');
		$mailingListEntry->save();
		return Redirect::to('/success')->withMessage('Grazie per esserti iscritto alla nostra mailing list!');
	}


	
	
	
}