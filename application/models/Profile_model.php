<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends MY_Model
{

    public $table = 'pegawai';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'tempat_lahir',
                'label' => 'Tempat Lahir',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'tgl_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'required|trim'
            ],
            

        ];

        return $validationRules;
    }
}

/* End of file Profile_model.php */
