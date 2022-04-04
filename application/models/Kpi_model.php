<?php
 
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Kpi_model extends MY_Model {
 
     public $table = 'kpi';

     public function getValidationRules()
     {
         $validationRules = [
            [
                'field' => 'kehadiran',
                'label' => 'Kehadiran',
                'rules' => 'required|max_length[1]|callback_only_alphabet_kehadiran'
            ],

            [
                'field' => 'kinerja',
                'label' => 'Kinerja',
                'rules' => 'required|max_length[1]|callback_only_alphabet_kinerja'
            ],
        ];

        return $validationRules;
     }
 
 }
 
 /* End of file Kpi_model.php */
 