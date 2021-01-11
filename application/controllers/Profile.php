<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$is_login = $this->session->userdata('is_login');

		if ($is_login != true) {
			redirect(base_url());
			return;
		}

		//Do your magic here
	}

	public function index()
	{
		$data['title']          = 'Profile';
		$data['nav_title']      = 'profile';
		$data['detail_title']   = 'profile';
		$data['page'] 			= 'pages/profile/index';

		$this->view($data);
	}

	public function edit($nip)
	{
		$data['title']        = 'Form Edit Profile';
		$this->profile->table = 'pegawai';
		$data['getPegawai']    = $this->profile->where('nip', $nip)->first();
		$this->output->set_output(show_my_modal('pages/profile/modal/modal_edit_profile', 'modal-edit-profile', $data, 'lg'));
	}

	public function update()
	{
		$nip  = $this->session->userdata('nip');
		$nama = $this->input->post('nama', true);
		$password = $this->input->post('password', true);
		$confirm_password = $this->input->post('confirm_password', true);


		if (!$this->profile->validate()) {


			$array = [
				'error' => true,
				'statusCode' 		 		 => 400,
				'nama_error' 	     		 => form_error('nama'),
				//'confirm_password_error'	 => $password != '' && $confirm_password != '' ? form_error('confirm_password') : "" //$password != $confirm_password ? '<small class="text-danger">Password dan Konfirmasi Password Tidak Cocok</small>' : ""
			];




			echo json_encode($array);
		} else {

			if ($password == '' && $confirm_password == '') {
				$data = [
					'nama'   		 => $nama,

				];
			} else {
				$data = [
					'nama'			 => $nama,
					'password'		 => hashEncrypt($password)
				];
			}


			$this->profile->table = 'pegawai';

			if ($password == $confirm_password) {
				if ($this->profile->where('nip', $nip)->update($data)) {
					echo json_encode(array(
						"statusCode" => 200,

					));


					$array = array(
						'name' => $nama
					);

					$this->session->set_userdata($array);
				} else {
					echo json_encode(array(
						"statusCode" => 201,
					));
				}
			} else {
				echo json_encode(array(
					'error' => true,
					'statusCode' 		 		 => 400,
					'nama_error' 	     		 => form_error('nama'),
					'confirm_password_error'	 => $password != $confirm_password ? '<small class="text-danger">Password dan Konfirmasi Password Tidak Cocok</small>' : ""
				));
			}
		}
	}
}
