<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends MY_Model
{

    public $table = 'pegawai';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'tgl_start',
                'label' => 'Tanggal Awal',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tgl_end',
                'label' => 'Tanggal Akhir',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Report_model.php */
