<?php


class Code extends Eloquent  {


	protected $fillable = array('id','product', 'oboli', 'user', 'notes');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'codes';


}
