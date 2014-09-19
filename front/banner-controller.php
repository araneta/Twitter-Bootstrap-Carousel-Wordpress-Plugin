<?php
class CarouselPluginFrontBannerController extends CarouselPluginFrontController{
	
	public static function get_model(){
		return self::load_module('Banners');
	}	
	public static function execute(){
	}
	
	public static function render_carousel(){
		$banners = self::get_model()->get_all();
		self::view('carousel',array(
			'banners'=>$banners
		));
	}
	
}
