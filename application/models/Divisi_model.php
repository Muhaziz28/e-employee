<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Divisi_model extends MY_Model
{


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_divisi',
                'label' => 'Nama Divisi',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Divisi_model.php */
