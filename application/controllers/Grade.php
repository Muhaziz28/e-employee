<?php

use function PHPSTORM_META\map;

defined('BASEPATH') or exit('No direct script access allowed');

class Grade extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role != 'hrd') {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['title']          = 'Grade - Daftar Grade';
        $data['nav_title']      = 'grade';
        $data['detail_title']   = 'grade';
        $data['page']           = 'pages/grade/index';

        $this->view($data);
    }

    public function insert()
    {
        $id_level                   = $this->input->post('id_level', true);
        $nama_grade                 = $this->input->post('nama_grade', true);
        $gaji_pokok                 = $this->input->post('gaji_pokok', true);
        $tunjangan_kehadiran        = $this->input->post('tunjangan_kehadiran', true);
        $tunjangan_operasional      = $this->input->post('tunjangan_operasional', true);

        if (!$this->grade->validate()) {
            $array = array(
                'error'                                 => true,
                'statusCode'                            => 400,
                'id_level_error'                        =>  form_error('id_level'),
                'nama_grade_error'                      =>  form_error('nama_grade'),
                'gaji_pokok_error'                      =>  form_error('gaji_pokok'),
                'tunjangan_kehadiran_error'             =>  form_error('tunjangan_kehadiran'),
                'tunjangan_operasional_error'           =>  form_error('tunjangan_operasional'),
            );

            echo json_encode($array);
        } else {
            $data = [
                'id_level'              => $id_level,
                'title'                 => $nama_grade,
                'gaji_pokok'            => (int) str_replace(".", "", $gaji_pokok),
                'tunjangan_kehadiran'   => (int) str_replace(".", "", $tunjangan_kehadiran),
                'tunjangan_operasional' => (int) str_replace(".", "", $tunjangan_operasional),
            ];

            if ($this->grade->add($data) == true) {
                echo json_encode([
                    'statusCode'            => 200,
                ]);
            } else {
                echo json_encode([
                    'statusCode'            => 201,
                ]);
            }
        }
    }

    public function showForm()
    {
        $data['title']     = 'Form Tambah Grade';
        $this->grade->table = 'level';
        $data['getLevel']    = $this->grade->get();
        $this->output->set_output(show_my_modal('pages/grade/modal/modal_add_form', 'modal-add-grade', $data, 'lg'));
    }

    public function showFormEdit($id)
    {
        $data['title']          = 'Form Edit Grade';

        $this->grade->table = 'level';
        $data['getLevel']   = $this->grade->get();


        $this->grade->table = 'grade';
        $data['getGrade']   = $this->grade->select([
            'grade.id', 'grade.title', 'grade.gaji_pokok', 'grade.tunjangan_kehadiran', 'grade.id_level',
            'grade.tunjangan_operasional', 'level.nama_level'
        ])
            ->join('level')
            ->where('grade.id', $id)
            ->first();

        $this->output->set_output(show_my_modal('pages/grade/modal/modal_edit_form', 'modal-edit-grade', $data, 'lg'));
    }

    public function update()
    {
        $id                         = $this->input->post('id', true);
        $id_level                   = $this->input->post('id_level', true);
        $nama_grade                 = $this->input->post('nama_grade', true);
        $gaji_pokok                 = $this->input->post('gaji_pokok', true);
        $tunjangan_kehadiran        = $this->input->post('tunjangan_kehadiran', true);
        $tunjangan_operasional      = $this->input->post('tunjangan_operasional', true);

        if (!$this->grade->validate()) {
            $array = [
                'error'                                      =>  true,
                'statusCode'                                 =>  400,
                'id_level_edit_error'                        =>  form_error('id_level'),
                'nama_grade_edit_error'                      =>  form_error('nama_grade'),
                'gaji_pokok_edit_error'                      =>  form_error('gaji_pokok'),
                'tunjangan_kehadiran_edit_error'             =>  form_error('tunjangan_kehadiran'),
                'tunjangan_operasional_edit_error'           =>  form_error('tunjangan_operasional'),
            ];

            echo json_encode($array);
        } else {
            $data = [
                'id_level'              => $id_level,
                'title'                 => $nama_grade,
                'gaji_pokok'            => (int) str_replace(".", "", $gaji_pokok),
                'tunjangan_kehadiran'   => (int) str_replace(".", "", $tunjangan_kehadiran),
                'tunjangan_operasional' => (int) str_replace(".", "", $tunjangan_operasional),
            ];

            if ($this->grade->where('id', $id)->update($data)) {
                echo json_encode([
                    'statusCode'        => 200,
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                ]);
            }
        }
    }

    public function loadTable()
    {
        $data['content']        = $this->grade->orderBy('created_at', 'ASC')->get();
        $this->load->view('pages/grade/table_ajax', $data);
    }

    public function destroy($id)
    {

        if ($this->input->is_ajax_request()) {
            if ($this->grade->where('id', $id)->delete()) {
                echo json_encode(array(
                    "statusCode" => 200,

                ));
            } else {
                echo json_encode(array(
                    "statusCode" => 201,
                ));
            }
        } else {
            echo '<h3>Tidak Memiliki Akses</h3>';
        }
    }
}

/* End of file Grade.php */
