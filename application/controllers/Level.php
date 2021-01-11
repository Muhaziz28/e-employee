<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Level extends MY_Controller
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

        $data['title']          = 'Level - Daftar Level';
        $data['nav_title']      = 'level';
        $data['detail_title']   = 'level';
        $data['page']           = 'pages/level/index';

        $this->view($data);
    }


    public function showForm()
    {
        $data['title']     = 'Form Tambah Level';
        $this->output->set_output(show_my_modal('pages/level/modal/modal_add_form', 'modal-add-level', $data, 'lg'));
    }

    public function showFormEdit($id)
    {
        $data['title']     = 'Form Edit Level';
        $data['getLevel'] = $this->level->where('id', $id)->first();
        $this->output->set_output(show_my_modal('pages/level/modal/modal_edit_form', 'modal-edit-level', $data, 'lg'));
    }

    public function insert()
    {
        $nama_level = $this->input->post('nama_level', true);
        $ket = $this->input->post('ket', true);

        if (!$this->level->validate()) {
            $array = array(
                'error' => true,
                'statusCode' => 400,
                'nama_level_error' => form_error('nama_level')
            );

            echo json_encode($array);
        } else {
            $data = [
                'nama_level' => $nama_level,
                'ket'         => $ket
            ];

            if ($this->level->add($data) == true) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "tes"        => array(
                        'tes1'  => "hellow world",
                        'tes2'  => "love you"
                    )

                ));
            } else {
                echo json_encode(array(
                    "statusCode" => 201,
                ));
            }
        }
    }

    public function update()
    {
        $id               = $this->input->post('id', true);
        $nama_level       = $this->input->post('nama_level', true);
        $ket              = $this->input->post('ket', true);

        if (!$this->level->validate()) {
            $array = [
                'error' => true,
                'statusCode' => 400,
                'nama_level_error' => form_error('nama_level')
            ];

            echo json_encode($array);
        } else {
            $data = [
                'nama_level'   => $nama_level,
                'ket'           => $ket
            ];

            if ($this->level->where('id', $id)->update($data)) {
                echo json_encode(array(
                    "statusCode" => 200,

                ));
            } else {
                echo json_encode(array(
                    "statusCode" => 201,
                ));
            }
        }
    }


    public function destroy($id)
    {

        if ($this->input->is_ajax_request()) {
            if ($this->level->where('id', $id)->delete()) {
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


    public function loadTable()
    {
        $data['content']        = $this->level->orderBy('created_at', 'DESC')->get();
        $this->load->view('pages/level/table_ajax', $data);
    }
}

/* End of file Level.php */
