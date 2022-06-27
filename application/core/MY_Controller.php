<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//Time Zone
		date_default_timezone_set("Asia/kolkata");
	}

	// callback function for allowing alphabets and space
	public function alpha_space($str) 
	{
	    if ( ! preg_match("/^([a-z ])+$/i", $str)){
	    	// custom error message
			$this->form_validation->set_message('alpha_space', 'The {field} field may only contain alphabetical characters.');
	        return false;
	    }
	    else{
	    	return true;
	    }
	}

	// callback function for allowing alphabets , numbers , full stop and comma.
	public function customAlpha($str) 
	{
	    if ( !preg_match('/^[a-z0-9 .,\-]+$/i',$str) ){
	    	// custom error message
			$this->form_validation->set_message('customAlpha', 'The {field} field may only contain alphabetical characters and numbers.');
	        return false;
	    }
	    else{
	    	return true;
	    }
	}

	// callback function for allowing alphabets , numbers , full stop and comma.
	public function customNumber($str) 
	{
	    if ( !preg_match('/^[0-9]+$/i',$str) ){
	    	// custom error message
			$this->form_validation->set_message('customNumber', 'The {field} field may only contain numbers.');
	        return false;
	    }
	    else{
	    	return true;
	    }
	}

	// callback function for allowing date.
	public function customNumDate($str) 
	{
	    if ( !preg_match('/^(((0)[0-9])|((1)[0-2]))(\/)([0-2][0-9]|(3)[0-1])(\/)\d{4}$/i',$str) ){
	    	// custom error message
			$this->form_validation->set_message('customNumDate', 'The {field} field may only contain date format (mm/dd/yyyy).');
	        return false;
	    }
	    else{

	    	return true;
	    }
	}
}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
?>