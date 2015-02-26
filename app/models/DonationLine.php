<?php


class DonationLine extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'donation_lines';


	function __construct($donation_id, $code, $obolis) {
       		$this->donation = $donation_id;
       		$this->code = $code;
			$this->obolis = $obolis;			
	}


}
