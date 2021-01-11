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
            

        ];

        return $validationRules;
    }
}

/* End of file Profile_model.php */
