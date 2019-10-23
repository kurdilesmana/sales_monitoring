<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
  var $W_SharedPath;	
	function __construct() {
		parent::__construct();
		$this->W_SharedPath = "../../shared/";
	}
	
	function sharedLibrary($library = '', $params = NULL) {
		parent::library($this->W_SharedPath."libraries/".$library, $params);
	}
	
	function sharedModel($model, $name = '', $db_conn = FALSE) {
		parent::model($this->W_SharedPath."models/".$model, $name, $db_conn);
	}
	
	function sharedView($view, $vars = array(), $return = FALSE) {
		return parent::view($this->W_SharedPath."views/".$view, $vars, $return);
	}
	
	function sharedHelper($helper) {
		if (is_string($helper)) {
			parent::helper($this->W_SharedPath."helpers/".$helper);
		}
	}
	
	function sharedConfig($file = '') {
		parent::config($this->W_SharedPath."config/".$file, true, false);
	}
}