<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_model extends MY_Model
{


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_lokasi',
                'label' => 'Nama Lokasi',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'alamat',
                'label' => 'Alamat Lokasi',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Divisi_model.php */
