<?php


class Code extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'codes';


	/**
	 * Get the unique identifier for the project.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Get number of obolis corrisponding to the code
	 *
	 * @return integer
	 */
	public function getOboli()
	{
		return $this->oboli;
	}
	
	public function getProductName()
	{
		return $this->product;
	}
	
	public function getUser()
	{
		return $this->user;
	}


}
