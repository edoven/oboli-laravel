<?php

use Carbon\Carbon;

include_once(app_path().'/utils.php');



class AdminController extends BaseController {
	

	public function showCodes()
	{
		$codes = Code::all();
		return View::make('admin.codes')->with('codes', $codes)
										->with('codes_count', count($codes))
										->with('unused_codes_count', DB::table('codes')->where('user', '=', null)->count() );
	}

	public function showUsers()
	{
		$users = User::all();
		return View::make('admin.users')->with('users', $users)
										->with('users_count', count($users));
	}


	public function addCode()
	{
		$user = Input::get('user');
		$secret = Input::get('secret');
		if ($user!='EdoErMejoDerColosseo' || $secret!='EdoErFigoDeRoma00')
			return Utils::create_json_response('error', 403, 'wrong credentials', null, Input::all());
		$obolis = Input::get('obolis');
		$product_id = Input::get('product_id');
		$code = Input::get('code');
		if ($code==null || $obolis==null || $product_id==null)
			return Utils::create_json_response('error', 400, 'code or obolis or product_id missing', null, Input::all());		
		if (Code::find($code) != null)
			return Utils::create_json_response('error', 400, 'code already exists', null, Input::all());
		if (Product::find($product_id) == null)
			return Utils::create_json_response('error', 400, 'product does not exists', null, Input::all());
		$notes = (Input::get('notes')!=null) ? Input::get('notes') : '';
		try {
			Code::create(array('id' => $code, 'product' => $product_id, 'oboli' => $obolis));
			return Utils::create_json_response('success', 200, 'code added', null, Input::all());
		}
		catch (Exception $e) {
			return Utils::create_json_response('error', 400, 'error adding code', $e->getMessage(), Input::all());
		}
		
	}
}
