<?php
class CarouselPluginModels_Base{
	protected $table_name;
	protected $errors = array();
	
	protected function add_error($key,$msg){
		$this->errors[$key]= $msg;
	}
	protected function has_errors(){
		return (count($this->errors)>0)? TRUE : FALSE;
	}
	public function get_error_msg(){
		if(count($this->errors)==0)
			return NULL;
		$msg = '';
		foreach($this->errors as $k=>$v){
			$msg .= $v.'<br />';
		}
		return $msg;
	}
	public function load_model($modelname){
		require_once strtolower($modelname).".php";
		$modelnamefull = LMJ_CAROUSEL.'_CLASS_PREFIX'.'Models_'.$modelname;
		return new $modelnamefull;
	}
	public function save($data){
		global $wpdb;
		if(!empty($data['id'])){			
			$ret = $wpdb->update( 
				$this->table_name, 
				$data,
				array('id' => $data['id'])
			);
		}else{				
			$ret = $wpdb->insert( 
				$this->table_name, 
				$data
			);
		}
		if(!$ret){
			$this->add_error('sql',$wpdb->last_error);
		}
		return $ret;
	}
	public function last_error(){
		global $wpdb;
		return $wpdb->last_error;
	}
	public function update($data,$id){
		global $wpdb;
		return $wpdb->update( 
			$this->table_name, 
			$data,
			array('id' => $id)
		);
	}
	public function insert($data){
		global $wpdb;
		return $wpdb->insert( 
			$this->table_name, 
			$data
		);
	}
	public function get_all(){
		global $wpdb;
		return  $wpdb->get_results('select * from '.$this->table_name);
	}
	public function get_by_id($id){
		global $wpdb;
		return $wpdb->get_row('SELECT * FROM '.$this->table_name.' WHERE id = '.intval($id));
	}
	public function delete($id){
		global $wpdb;
		return $wpdb->delete( $this->table_name, array( 'id' => $id ) );
	}
	
}
