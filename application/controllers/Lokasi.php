<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends MY_Controller
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

        $data['title']          = 'Lokasi - Daftar Lokasi';
        $data['nav_title']      = 'lokasi';
        $data['detail_title']   = 'lokasi';
        $data['page']           = 'pages/lokasi/index';

        $this->view($data);
    }


    public function showForm()
    {
        $data['title']     = 'Form Tambah Lokasi';
        $this->output->set_output(show_my_modal('pages/lokasi/modal/modal_add_form', 'modal-add-lokasi', $data, 'lg'));
    }

    public function showFormEdit($id)
    {
        $data['title']     = 'Form Edit Lokasi';
        $data['getLokasi'] = $this->lokasi->where('id', $id)->first();
        $this->output->set_output(show_my_modal('pages/lokasi/modal/modal_edit_form', 'modal-edit-lokasi', $data, 'lg'));
    }

    public function insert()
    {
        $nama_lokasi = $this->input->post('nama_lokasi', true);
        $alamat = $this->input->post('alamat', true);

        if (!$this->lokasi->validate()) {
            $array = array(
                'error' => true,
                'statusCode' => 400,
                'nama_lokasi_error' => form_error('nama_lokasi'),
                'alamat_error'      => form_error('alamat')
            );

            echo json_encode($array);
        } else {
            $data = [
                'nama_lokasi' => $nama_lokasi,
                'alamat'         => $alamat
            ];

            if ($this->lokasi->add($data) == true) {
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
        $nama_lokasi      = $this->input->post('nama_lokasi', true);
        $alamat           = $this->input->post('alamat', true);

        if (!$this->lokasi->validate()) {
            $array = [
                'error' => true,
                'statusCode' => 400,
                'nama_lokasi_error' => form_error('nama_lokasi')
            ];

            echo json_encode($array);
        } else {
            $data = [
                'nama_lokasi'      => $nama_lokasi,
                'alamat'           => $alamat
            ];

            if ($this->lokasi->where('id', $id)->update($data)) {
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
            if ($this->lokasi->where('id', $id)->delete()) {
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
        $data['content']        = $this->lokasi->orderBy('created_at', 'DESC')->get();
        $this->load->view('pages/lokasi/table_ajax', $data);
    }
}

/* End of file Lokasi.php */
