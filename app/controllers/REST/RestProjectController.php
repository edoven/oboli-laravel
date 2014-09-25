<?php

class RestProjectController extends BaseController {
	
	public function showAll()
	{
		$projects = Project::all();

        return Response::json(array(
            'status' => 'success',
            'projects' => $projects->toArray()),
            200
        );		
	}
}
