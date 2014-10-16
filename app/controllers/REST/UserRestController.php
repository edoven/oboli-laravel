<?php

include_once app_path().'/utils.php';

class UserRestController extends BaseController {
	
	//public function showAll()
	//{
		//$users = User::all();

        //return Response::json(array(
            //'status' => 'success',
            //'users' => $users->toArray()),
            //200
        //);		
	//}
	
	public function showProfile($id)
	{
		if (Input::get('user_id') != $id)
			return Response::json(array(
				'status' => 'error',
				'code' => '401',
				'id' => $id,
				'user_id' => Input::get('user_id'),
				'message' => 'unauthorized request',
				'message_verbose' => 'you can only access to your own profile'),
				401
			);	
		
		$user = User::findOrFail($id);	//this already manage the web vs rest response (look at errors.php)
		$donations = Donation::where('user_id', '=', $id)->get();
		return Response::json(array(
			'status' => 'success',
			'user' => $user->toArray(),
			'donations' => $donations->toArray()),
			200
		);	
	}
	
	
	public function makeDonation()
	{		
		$user_id = Input::get('user_id');
		$ngo_id = Input::get('ngo_id');
		$amount = Input::get('amount'); //CHECK >0
		$return_array = (new Utils)->makeDonation($user_id, $ngo_id, $amount);
		if ($return_array['code']==400)
			return Response::json(array(
				'status' => 'error',
				'message' => $return_array['message']),
				400
			);
		return Response::json(array(
				'status' => 'success',
				'message' => 'a donation of '.$amount.' obolis to ngo '.$ngo_id.' has been made',
				'sharable_message' => 'a nice message you can spread to the world'),
				200
			);
	}
}
