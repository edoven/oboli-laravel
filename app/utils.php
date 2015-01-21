<?php


class Utils
{

	
	
    public function sendConfirmationEmail($name, $email, $confirmation_code)
	{
		$configs = include(app_path().'/config/local-config.php');
		$messageData = array(
			'title' => 'Email',
			'name' => $name,
			'link' => $configs['host'].'/signin/confirm?email='.$email.'&confirmation_code='.$confirmation_code
			);	
		Mail::send('emails.confirmation', 
				   $messageData, 
				   function($message) use($email) {
				   		$message->to($email)->subject('Oboli - conferma registrazione');}
				   );
	}
	
	


	public static function create_json_response($status, $code, $message, $message_verbose, $data)
	{
		$response_array = array(
								'status' => $status,
								'code' => strval($code),
								'message' => ($message != null ? $message : ''),
								'message_verbose' => ($message_verbose != null ? $message_verbose : ''),
								'data' => ($data != null ? $data : array())
								);
		return Response::json($response_array, $code, [],  JSON_PRETTY_PRINT+JSON_UNESCAPED_SLASHES);
	}




	//used by services to create responses
	public static function returnError($message, $data)
	{
		return array('status'=>'error',
					 'message'=>$message,
					 'data'=>$data);
	}

	//used by services to create responses
	public static function returnSuccess($message, $data)
	{
		return array('status'=>'success',
					 'message'=>$message,
					 'data'=>$data);
	}


	public static function createCurlPostCall($url, $data_array)
	{
		

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_array));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	public static function createCurlGetCall($url)
	{
		$ch = curl_init();
		//$url = $url.'?'.http_build_query($data_array);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
		
}

?>
