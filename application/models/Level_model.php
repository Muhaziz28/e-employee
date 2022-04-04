<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Level_model extends MY_Model
{


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_level',
                'label' => 'Nama Level',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Level_model.php */
