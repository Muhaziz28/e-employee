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
        $data['page']             = 'pages/profile/index';

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
        $email = $this->input->post('email', true);
        $tempat_lahir = $this->input->post('tempat_lahir', true);
        $tgl_lahir  = $this->input->post('tgl_lahir', true);
        $password = $this->input->post('password', true);
        $confirm_password = $this->input->post('confirm_password', true);


        if (!$this->profile->validate()) {


            $array = [
                'error' => true,
                'statusCode'                   => 400,
                'nama_error'                   => form_error('nama'),
                'email_error'                => form_error('email'),
                'tempat_lahir'               => form_error('tempat_lahir'),
                'tgl_lahir'                  => form_error('tgl_lahir')
                //'confirm_password_error'	 => $password != '' && $confirm_password != '' ? form_error('confirm_password') : "" //$password != $confirm_password ? '<small class="text-danger">Password dan Konfirmasi Password Tidak Cocok</small>' : ""
            ];

            echo json_encode($array);
        } else {

            if ($password == '' && $confirm_password == '') {
                $data = [
                    'nama'            => $nama,
                    'email'          => $email,
                    'tempat_lahir'   => $tempat_lahir,
                    'tgl_lahir'      => $tgl_lahir

                ];
            } else {
                $data = [
                    'nama'             => $nama,
                    'email'          => $email,
                    'tempat_lahir'   => $tempat_lahir,
                    'tgl_lahir'      => $tgl_lahir,
                    'password'         => hashEncrypt($password)
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
                    'statusCode'                   => 400,
                    'nama_error'                   => form_error('nama'),
                    'confirm_password_error'     => $password != $confirm_password ? '<small class="text-danger">Password dan Konfirmasi Password Tidak Cocok</small>' : ""
                ));
            }
        }
    }

    public function history_gaji()
    {
        $data['title']            = 'Riwayat Gaji';


        $this->output->set_output(show_my_modal('pages/gaji/modal/modal_history_gaji', 'modal-history-gaji', $data, 'lg'));
    }

    public function loadTableModal($nip)
    {
        $this->profile->table      = 'slip_gaji';
        $data['getGaji']        = $this->profile->select([
            'slip_gaji.id', 'gaji.jumlah_gaji', 'slip_gaji.total_gaji', '.slip_gaji.created_at', 'slip_gaji.nip_pegawai',
        ])
            ->orderBy('slip_gaji.created_at', 'DESC')
            ->where('slip_gaji.nip_pegawai', $nip)
            ->join('gaji')
            ->get();


        $this->load->view('pages/gaji/modal/table_ajax', $data);
    }

    public function viewSlipGajiEmp($id, $nip)
    {
        $data['title']          = 'Slip Gaji';
        $data['emp']            = true;

        $this->profile->table      = 'pegawai';
        $data['pegawai']        = $this->profile->where('pegawai.nip', $nip)->join('divisi')
            ->join('jabatan')
            ->join('lokasi')
            ->first();

        $this->profile->table      = 'slip_gaji';
        $data['slip_gaji']      = $this->profile->where('slip_gaji.id', $id)
            ->first();

        $this->profile->table      = 'gaji';
        $data['gaji']           = $this->profile->where('gaji.nip_pegawai', $nip)->first();
        $this->output->set_output(show_my_modal('pages/gaji/modal/modal_view_slip_gaji2', 'modal-view-slip-gaji2', $data, 'lg'));
    }
}
