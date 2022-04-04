<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends MY_Controller
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

        $data['title']          = 'Divisi - Daftar Divisi';
        $data['nav_title']      = 'divisi';
        $data['detail_title']   = 'divisi';
        $data['page']           = 'pages/divisi/index';

        $this->view($data);
    }


    public function showForm()
    {
        $data['title']     = 'Form Tambah Divisi';
        $this->output->set_output(show_my_modal('pages/divisi/modal/modal_add_form', 'modal-add-divisi', $data, 'lg'));
    }

    public function showFormEdit($id)
    {
        $data['title']     = 'Form Edit Divisi';
        $data['getDivisi'] = $this->divisi->where('id', $id)->first();
        $this->output->set_output(show_my_modal('pages/divisi/modal/modal_edit_form', 'modal-edit-divisi', $data, 'lg'));
    }

    public function insert()
    {
        $nama_divisi = $this->input->post('nama_divisi', true);
        $ket = $this->input->post('ket', true);

        if (!$this->divisi->validate()) {
            $array = array(
                'error' => true,
                'statusCode' => 400,
                'nama_divisi_error' => form_error('nama_divisi')
            );

            echo json_encode($array);
        } else {
            $data = [
                'nama_divisi' => $nama_divisi,
                'ket'         => $ket
            ];

            if ($this->divisi->add($data) == true) {
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

    public function update()
    {
        $id               = $this->input->post('id', true);
        $nama_divisi = $this->input->post('nama_divisi', true);
        $ket         = $this->input->post('ket', true);

        if (!$this->divisi->validate()) {
            $array = [
                'error' => true,
                'statusCode' => 400,
                'nama_divisi_error' => form_error('nama_divisi')
            ];

            echo json_encode($array);
        } else {
            $data = [
                'nama_divisi'   => $nama_divisi,
                'ket'           => $ket
            ];

            if ($this->divisi->where('id', $id)->update($data)) {
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
            if ($this->divisi->where('id', $id)->delete()) {
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
        $data['content']        = $this->divisi->orderBy('created_at', 'DESC')->get();
        $this->load->view('pages/divisi/table_ajax', $data);
    }
}

/* End of file Divisi.php */
