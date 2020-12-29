<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	
	public function index()
	{
		$data['title']          = 'Dashboard - Daftar Divisi';
        $data['nav_title']      = 'dashboard';
        $data['detail_title']   = 'dashboard';
		$data['page'] 			= 'pages/dashboard/index';

		$this->view($data);
	}
}
