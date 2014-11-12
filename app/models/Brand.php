<?php


class Brand extends Eloquent  {


	protected $fillable = array('name');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'brands';


}
