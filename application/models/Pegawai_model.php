<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends MY_Model
{

    public $table = 'pegawai';
    public $perPage = 9;

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'email',
                'label' => 'Alamat Email',
                'rules' => 'trim|required|valid_email'
            ],

            [
                'field' => 'tempat_lahir',
                'label' => 'Tempat Lahir',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'tgl_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'nohp',
                'label' => 'No HP',
                'rules' => 'trim|required|is_numeric'
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'agama',
                'label' => 'Agama',
                'rules' => 'required'
            ],

            [
                'field' => 'status',
                'label' => 'Status Nikah',
                'rules' => 'required'
            ],

            [
                'field' => 'pendidikan',
                'label' => 'Pendidikan',
                'rules' => 'required'
            ],

            [
                'field' => 'status_pegawai',
                'label' => 'Status Pegawai',
                'rules' => 'required'
            ],

            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'tgl_masuk',
                'label' => 'Tanggal Masuk',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'id_divisi',
                'label' => 'Divisi',
                'rules' => 'required'
            ],

            [
                'field' => 'id_jabatan',
                'label' => 'Jabatan',
                'rules' => 'required'
            ],

            [
                'field' => 'id_level',
                'label' => 'Tingkatan Pegawai',
                'rules' => 'required'
            ],

            [
                'field' => 'id_lokasi',
                'label' => 'Penempatan',
                'rules' => 'required'
            ],

            [
                'field' => 'tgl_mulai_kontrak',
                'label' => 'Tanggal Mulai Kontrak',
                'rules' => 'callback_check_status_pegawai'
            ],

            [
                'field' => 'tgl_akhir_kontrak',
                'label' => 'Tanggal Akhir Kontrak',
                'rules' => 'callback_check_status_pegawai'
            ]



        ];

        return $validationRules;
    }


    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './images/pegawai',
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'          => 2048,
            'max_width'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./images/pegawai/$fileName")) {
            unlink("./images/pegawai/$fileName");
        }
    }
}

/* End of file Pegawai_model.php */
