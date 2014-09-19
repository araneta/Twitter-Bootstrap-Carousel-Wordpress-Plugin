<?php
/*
 * Plugin Name: Carousel Plugin
 * Plugin URI: http://www.aldoapp.com
 * Description: Create simple carousel
 * Version: 1
 * Author: Aldo Praherda
 * Author URI: http://www.aldoapp.com
 * License: GPLv2 or later
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */
ini_set('display_errors', 1); 
error_reporting(E_ALL);
define('LMJ_CAROUSEL_SLUG','carousel');
define('LMJ_CAROUSEL_ROOT',plugin_dir_path( __FILE__ ));
define('LMJ_CAROUSEL_URL',plugins_url().'/carousel');

define('LMJ_CAROUSEL_CLASS_PREFIX','CarouselPlugin');

class CarouselPlugin{
	/**
     * Constructor
     */
    public function __construct() {
		//for flash message
		if (!session_id())
			session_start();
			
		register_activation_hook(__FILE__, array( $this, 'activate'));
		//hooks			
		//cron		
		add_action('plugins_loaded',array($this,'execute'));
		//admin pages		
		if(is_admin()){					
			//register all controllers here
			require_once(LMJ_CAROUSEL_ROOT.'/admin/controllers/admin-controller.php');
			//Your admin controller
			require_once(LMJ_CAROUSEL_ROOT.'/admin/controllers/banner-controller.php');			
			//actions			
			add_action('admin_menu',array($this,'register_admin_menu'));
			add_action('admin_enqueue_scripts', array('CarouselPluginBannerController','my_admin_scripts'));
						
		}else{		
			//front end
			require_once(LMJ_CAROUSEL_ROOT.'/front/front-controller.php');
			//your front controller here
			require_once(LMJ_CAROUSEL_ROOT.'/front/banner-controller.php');
			//shortcode
			add_shortcode('carousel_show', array('CarouselPluginFrontBannerController','render_carousel'));
		}
	}
	public static function activate(){
		require_once(LMJ_CAROUSEL_ROOT.'/install.php');
		PluginInstall::install();
	}
	
	function log($text){
		$logfile = dirname(__FILE__).'/pr0.log';	
		$f = fopen($logfile,'a+');
		fwrite($f,$text."\r\n");
		fclose($f);
	}
	
	
	public function execute(){
		if(isset($_POST)){
			if(is_admin()){
				CarouselPluginBannerController::execute();				
			}else{
				CarouselPluginFrontBannerController::execute();
			}
		}	
	}
	
	function register_admin_menu() {		
		//main        
        $page = add_menu_page('Banner','Banner', 'edit_others_posts', LMJ_CAROUSEL_SLUG, 
			array('CarouselPluginBannerController', 'render_admin_page'),
			'dashicons-images-alt2'
		);
        //submenu
        //add banner        
        add_submenu_page( LMJ_CAROUSEL_SLUG, 'Banner Entry', 
			'Banner Entry', 
			'manage_options', LMJ_CAROUSEL_SLUG.'_banner_entry', 
			array('CarouselPluginBannerController','add_page_callback') 			
		); 		
    }
    
}

$sprp = new CarouselPlugin();
//$sprp->execute();
