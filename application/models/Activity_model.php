<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Activity_model extends MY_Model
{

    public $table = 'aktivitas';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'activity[]',
                'label' => 'Activity',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'mulai[]',
                'label' => 'Mulai',
                'rules' => 'trim|required|callback_validate_time'
            ],
            [
                'field' => 'akhir[]',
                'label' => 'Selesai',
                'rules' => 'trim|required|callback_validate_time'
            ],
            [
                'field' => 'realisasi[]',
                'label' => 'Realisasi',
                'rules' => 'trim|required'
            ],







        ];

        return $validationRules;
    }
    public function getValidationArrayRules($i)
    {
        $validationRules = [
            [
                'field' => 'activity[' . $i . ']',
                'label' => 'Activity',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'mulai[' . $i . ']',
                'label' => 'Mulai',
                'rules' => 'trim|required|callback_validate_time'
            ],
            [
                'field' => 'akhir[' . $i . ']',
                'label' => 'Selesai',
                'rules' => 'trim|required|callback_validate_time'
            ],
            [
                'field' => 'realisasi[' . $i . ']',
                'label' => 'Realisasi',
                'rules' => 'trim|required'
            ],







        ];

        return $validationRules;
    }
}

/* End of file Activity_model.php */
