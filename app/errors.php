<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;


App::error(function(ModelNotFoundException $e)
{	
	if (Request::is('api/v1/*'))
		{
			return Response::json(array(
				'status' => 'fail',
				'error' => 'ModelNotFoundException'),
				400
			);	
		}
    return Response::make('Not Found', 404);
});



?>
