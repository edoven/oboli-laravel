<?php


class Donation extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'donations';


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
	 * Get the user who made the donation.
	 *
	 * @return int
	 */
	public function getUser()
	{
		return $this->user_id;
	}
	
	/**
	 * Get the project the donation was made to.
	 *
	 * @return int
	 */
	public function getProject()
	{
		return $this->project_id;
	}
	
	/**
	 * Get the amount of the donation.
	 *
	 * @return int
	 */
	public function getAmount()
	{
		return $this->amount;
	}


}
