<?php

include_once(app_path().'/utils.php');


class ActiveProductRestController extends BaseController {
	

	public function getAll()
	{
		Log::info('ActiveProductRestController::show');
		$activeProducts = ActiveProduct::all();
		$enriched_activeProducts = array();
		foreach ($activeProducts as $activeProduct)
		{
			$enriched_activeProduct = array(
										'brand_name' => $activeProduct->brand_name,
										'img_url' => Config::get('local-config')['host'].'/img/mobile/active_products/'.$activeProduct->brand_name_short.'.jpg',
										'product_descritption' => $activeProduct->product_descritption,
										'url' => $activeProduct->url
				);
			array_push($enriched_activeProducts, $enriched_activeProduct);
		}
		return Utils::create_json_response("success", 200, null, null, $enriched_activeProducts);
	}

	
}
