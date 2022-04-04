<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Gaji_model extends MY_Model
{

    public $table = 'gaji';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'jumlah_gaji',
                'label' => 'Gaji Pokok',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'insentif_kehadiran',
                'label' => 'Tunjangan Kehadiran',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan',
                'label' => 'Tunjangan Operasioanl',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan_kerajinan',
                'label' => 'Tunjangan Kerajinan',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }

    public function getValidationRules2()
    {
        $validationRules = [
            [
                'field' => 'jumlah_gaji',
                'label' => 'Gaji Pokok',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan_leader',
                'label' => 'Tunjangan Leader',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan_kebersihan',
                'label' => 'Tunjangan Kebersihan',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan_keamanan',
                'label' => 'Tunjangan Keamanan',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tunjangan_dokter',
                'label' => 'Tunjangan Dokter',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Gaji_model.php */
