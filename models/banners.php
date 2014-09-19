<?php
require_once "base.php";

class CarouselPluginModels_Banners extends CarouselPluginModels_Base{		
	public function __construct(){
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'carousel_banner';
	}	
	
	public function validate($data){
		if(empty($data['title'])){
			$this->add_error('title','Title is empty');			
		}
		if(empty($data['image_url'])){
			$this->add_error('image_url','Image URL is empty');			
		}
		if(empty($data['target_url'])){
			$this->add_error('target_url','Target URL is empty');			
		}
		if(empty($data['target_window'])){
			$this->add_error('target_window','Target window is empty');			
		}
		if(empty($data['image_order']) || !ctype_digit(strval($data['image_order']))){
			$this->add_error('image_order','Image order is empty');			
		}
		return !$this->has_errors();
	}
	public function save($data){		
		if(!$this->validate($data)){
			return FALSE;
		}				
		$data = array( 
			'id'=>$data['id'],
			'title' => $data['title'], 
			'image_url' => stripslashes($data['image_url']), 
			'target_url' => stripslashes($data['target_url']), 
			'target_window' => stripslashes($data['target_window']), 
			'image_order' => intval($data['image_order']), 
		) ;
		return parent::save($data);
		
	}
	public function get_all(){
		global $wpdb;		
		return  $wpdb->get_results('select * from '.$this->table_name.' order by image_order asc');
	}
}
