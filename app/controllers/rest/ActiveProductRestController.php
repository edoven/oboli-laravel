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
										'brand_img_url' => Config::get('local-config')['host'].'/img/mobile/active_products/brands/'.$activeProduct->brand_name_short.'.png',
										'product_img_url' => Config::get('local-config')['host'].'/img/mobile/active_products/products/'.$activeProduct->brand_name_short.'.png',
										'product_descritption' => $activeProduct->product_descritption,
										'url' => $activeProduct->url
				);
			array_push($enriched_activeProducts, $enriched_activeProduct);
		}
		return Utils::create_json_response("success", 200, null, null, $enriched_activeProducts);
	}

	
}
