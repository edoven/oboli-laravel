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
    return Redirect::to('404');//return View::make('404');//Response::make('Not Found', 404);
});


App::missing(function($e) {
    $url = Request::fullUrl();
    Log::warning('404 for URL:'.$url);
	if (Request::is("api/*"))
		return Utils::create_json_response("error", 404, 'not found', null, null);
	else
    	return Redirect::to('404');//return "404 Error: not found";
});



?>
