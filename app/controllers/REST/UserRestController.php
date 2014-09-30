<?php

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
				'message' => 'unauthorized request'),
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
}
