<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Grade_model extends MY_Model
{
    public $table = 'grade';


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_level',
                'label' => 'Nama Level',
                'rules' => 'required'
            ],
            [
                'field' => 'nama_grade',
                'label' => 'Nama Grade',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'gaji_pokok',
                'label' => 'Gaji Pokok',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan_kehadiran',
                'label' => 'Tunjangan Kehadiran',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan_operasional',
                'label' => 'Tunjangan Operasional',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Grade_model.php */
