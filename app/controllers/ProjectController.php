<?php

class ProjectController extends BaseController {
		
	public function showAll()
	{
		$projects = Project::all();	
		return View::make('projects')->with('projects', $projects);
	}
	
	public function showDetail($id)
	{
		$project = Project::findOrFail($id);	
		$project_donations = Donation::where('project_id', '=', $id)->get();
		return View::make('project')->with('project', $project)
									->with('donations', $project_donations); 
	}
	
}
