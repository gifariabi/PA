<?php

class Test extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation','session');
		$this->load->model('Login_model');

	}
	
	public function index(){
        echo "Masuk";
    }
}