<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$is_login = $this->session->userdata('is_login');

		if($is_login != true)
		{
			redirect(base_url());
			return;
		}
		
		//Do your magic here
	}
	
	public function index()
	{
		$data['title']          = 'Dashboard';
        $data['nav_title']      = 'dashboard';
        $data['detail_title']   = 'dashboard';
		$data['page'] 			= 'pages/dashboard/index';

		$this->view($data);
	}

	
}
