<?php
class CarouselPluginBannerController extends CarouselPluginCarouselAdminController{	
	public static function get_model(){
		return self::load_module('Banners');		
	}	
	
	public static function execute(){		
		if(isset($_POST['save'])){					
			self::save();
		}else if(isset($_POST['delete'])){					
			self::delete();
		}		
	}
	//schedules
	public static function save(){
		$m = self::get_model();
		if($m->save($_POST)){
			$status = 'Saved';
			self::set_status('success',$status);	
			//redirect to list schedule page
			$redirect_url = $_POST['redirect'];			
			self::redirect($redirect_url);		
		}else{						
			$status = 'Error: '.$m->get_error_msg();			
			self::set_status('error',$status);
		}				
	}
	public static function delete(){
		$m = self::get_model();
		if($m->delete($_POST['id'])){
			$status = 'Deleted';
			self::set_status('success',$status);			
		}else{
			$status = 'Failed deleting schedule '.$_POST['id'];
			self::set_status('error',$status);	
		}		
		$redirect_url = $_POST['redirect'];
		self::redirect($redirect_url);			
	}
	
	public static function add_page_callback() {
		$banner = NULL;		
		$view = "banner/add";
		$redirect_url = menu_page_url(LMJ_CAROUSEL_SLUG,false);				
		//edit mode
		if(isset($_GET['id'])){
			$m = self::get_model();
			$banner = $m->get_by_id($_GET['id']);			
		}
		//delete mode
		else if(isset($_GET['delid'])){					
			$m = self::get_model();
			$banner = $m->get_by_id($_GET['delid']);				
			$view = "banner/delete";
			
		}
		else if(isset($_POST)){							
			$banner = new stdClass();
			$banner->title = isset($_POST['title'])?$_POST['title']:'';
			$banner->image_url = isset($_POST['image_url'])?stripslashes($_POST['image_url']):''; 
			$banner->target_url = isset($_POST['target_url'])?stripslashes($_POST['target_url']):'';
			$banner->target_window = isset($_POST['target_window'])?stripslashes($_POST['target_window']):'';
			$banner->image_order = isset($_POST['image_order'])?stripslashes($_POST['image_order']):'';
			
		}
		
 

		self::view($view,array(
			'banner'=>$banner,
			'redirect_url'=>$redirect_url,			
		));
	}
	public static function my_admin_scripts() {
		//if (isset($_GET['page']) && $_GET['page'] == 'my_plugin_page') {
			wp_enqueue_media();
			wp_register_script('banner-upload-js', LMJ_CAROUSEL_URL.'/admin/js/upload.js', array('jquery'));
			wp_enqueue_script('banner-upload-js');
		//}
	}
    public static function render_admin_page(){		
		$m = self::get_model('');		
		self::view("banner/list",array('banners' => $m->get_all()));
	}
	
	
	
	
}
