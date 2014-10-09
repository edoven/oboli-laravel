<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;


App::error(function(ModelNotFoundException $e)
{	
	if (Request::is('api/*'))
	{
		return Response::json(array(
			'status' => 'fail',
			'error' => 'ModelNotFoundException',
			'error_verbose' => 'A resource with the ID provided does not exist.'),
			404
		);	
	}
    return Response::make('Not Found', 404);
});



?>
