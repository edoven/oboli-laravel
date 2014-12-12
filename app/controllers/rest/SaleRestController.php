<?php



class SaleRestController extends BaseController {
	
	public function addSale() {
		$ip = Request::ip();
		$email = Input::get('email');
		$obolis = Input::get('obolis');
		$sale = new Sale;
		$sale->ip = $ip;
		$sale->email = $email;
		$sale->obolis = $obolis;
		$sale->save();
		return Utils::create_json_response("success", 200, null, null, array('ip' => $ip, 'email' => $email, 'obolis' => $obolis));
	}
}
