<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cuti_model extends MY_Model
{

    public $table = 'cuti';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'jenis_cuti',
                'label' => 'Jenis Cuti',
                'rules' => 'required'
            ],
            [
                'field' => 'lama_cuti',
                'label' => 'Lama Cuti',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'tgl_cuti',
                'label' => 'Tanggal Cuti',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'alasan_cuti',
                'label' => 'Alasan Cuti',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'alamat_cuti',
                'label' => 'Alamat Cuti',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'nip_pengganti',
                'label' => 'Pengganti Tugas',
                'rules' => 'required'
            ],

        ];

        return $validationRules;
    }

    public function getValidationRules2()
    {
        $validationRules = [

            [
                'field' => 'jatah_cuti',
                'label' => 'Jatah Cuti',
                'rules' => 'required|trim'
            ],



            [
                'field' => 'nip_pegawai',
                'label' => 'Nama Pegawai',
                'rules' => 'required'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Cuti_model.php */
