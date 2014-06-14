<?php


class Project extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';


	/**
	 * Get the unique identifier for the project.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id();
	}

	/**
	 * Get the name for the project.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Get the oboli donated to the project.
	 *
	 * @return int
	 */
	public function getOboliCount()
	{
		return $this->oboli_count;
	}
	
	/**
	 * Get the project description.
	 *
	 * @return string
	 */
	public function getShortDescription()
	{
		return $this->short_description;
	}


}
