<?php

class RestUserController extends BaseController {
	
	public function showAll()
	{
		$users = User::all();

        return Response::json(array(
            'status' => 'success',
            'users' => $users->toArray()),
            200
        );		
	}
}
