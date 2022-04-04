<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $role = $this->session->userdata('role');

        if ($is_login != true) {
            redirect(base_url());
            return;
        } else {
            if ($role == 'hrd') {
                redirect(base_url("dashboard"));
                return;
            } else {

                return;
            }
        }

        //Do your magic here
    }

    public function index()
    {
        $data['title']          = 'Home';
        $data['nav_title']      = 'home';
        $data['detail_title']   = 'home';
        $data['page']             = 'pages/home/index';

        $this->view($data);
    }
}
