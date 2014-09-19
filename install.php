<?php
class PluginInstall{
	public static function install(){
		//create tables
		global $wpdb;
		$Carousel_db_version = '1.1';
		
		$charset_collate = '';

		if ( ! empty( $wpdb->charset ) ) {
		  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}

		if ( ! empty( $wpdb->collate ) ) {
		  $charset_collate .= " COLLATE {$wpdb->collate}";
		}
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//create tables here
		$table_name = $wpdb->prefix . 'carousel_banner';
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,			
			title text NOT NULL,
			target_url text NOT NULL,		
			image_url text NOT NULL,
			target_window varchar(10) NOT NULL,	
			image_order tinyint DEFAULT 0 NOT NULL,
			UNIQUE KEY id (id)
		) $charset_collate;";
		//die($sql);	
		dbDelta( $sql );		
		
		add_option( 'Carousel_db_version', $Carousel_db_version );
	}
}
