<?php

class ProjectController extends BaseController {
		
	public function showAll()
	{
		$projects = Project::all();	
		
		if (Request::is('api/v1/*'))
		{
			return Response::json(array(
				'status' => 'success',
				'projects' => $projects->toArray()),
				200
			);	
		}
		return View::make('projects')->with('projects', $projects);
	}
	
	public function showDetails($id)
	{
		$project = Project::findOrFail($id);	
		$donations = Donation::where('project_id', $id)->get();
		
		if (Request::is('api/v1/*'))
		{
			return Response::json(array(
				'status' => 'success',
				'project' => $project->toArray(),
				'donations' => $donations->toArray()),
				//'donations' => $donations->toArray()),
				200
			);	
		}
		return View::make('project')->with('project', $project)
									->with('donations', $donations); 
	}
	
}
