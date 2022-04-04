<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends MY_Model {

    public $table = 'jabatan';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_jabatan',
                'label' => 'Nama Jabatan',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'id_divisi',
                'label' => 'Nama Divisi',
                'rules' => 'required'
            ],

        ];

        return $validationRules;
    }

}

/* End of file Jabatan_model.php */
