<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends MY_Controller
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
        $data['title']          = 'Jabatan - Daftar Jabatan';
        $data['nav_title']      = 'jabatan';
        $data['detail_title']   = 'jabatan';
        $data['page']           = 'pages/jabatan/index';

        $this->view($data);
    }

    public function showForm()
    {
        $data['title']        = 'Form Tambah Jabatan';
        $this->jabatan->table = 'divisi';
        $data['getDivisi']    = $this->jabatan->get();
        $this->output->set_output(show_my_modal('pages/jabatan/modal/modal_add_form', 'modal-add-jabatan', $data, 'lg'));
    }

    public function showFormEdit($id)
    {
        $data['title']     = 'Form Edit Jabatan';

        $this->jabatan->table = 'divisi';
        $data['getDivisi'] = $this->jabatan->get();

        $this->jabatan->table = 'jabatan';
        $data['getJabatan'] = $this->jabatan->select([
            'jabatan.id', 'jabatan.nama_jabatan', 'jabatan.ket', 'divisi.nama_divisi', 'divisi.id AS id_divisi'
        ])
            ->where('jabatan.id', $id)
            ->orderBy('jabatan.created_at', 'DESC')
            ->join('divisi')
            ->first();
        $this->output->set_output(show_my_modal('pages/jabatan/modal/modal_edit_form', 'modal-edit-jabatan', $data, 'lg'));
    }

    public function insert()
    {
        $nama_jabatan = $this->input->post('nama_jabatan', true);
        $id_divisi = $this->input->post('id_divisi', true);
        $ket = $this->input->post('ket', true);

        if (!$this->jabatan->validate()) {
            $array = array(
                'error' => true,
                'statusCode' => 400,
                'nama_jabatan_error' => form_error('nama_jabatan'),
                'id_divisi_error'    => form_error('id_divisi')

            );

            echo json_encode($array);
        } else {
            $data = [
                'nama_jabatan'  => $nama_jabatan,
                'id_divisi'     => $id_divisi,
                'ket'           => $ket
            ];

            if ($this->jabatan->add($data) == true) {
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

    public function loadTable()
    {
        $data['content']        = $this->jabatan->select([
            'jabatan.id', 'jabatan.nama_jabatan', 'jabatan.ket', 'divisi.nama_divisi'
        ])
            ->orderBy('jabatan.created_at', 'DESC')
            ->join('divisi')
            ->get();

        //print_r($data['content']);
        $this->load->view('pages/jabatan/table_ajax', $data);
    }

    public function update()
    {
        $id               = $this->input->post('id', true);
        $nama_jabatan    = $this->input->post('nama_jabatan', true);
        $id_divisi      = $this->input->post('id_divisi', true);
        $ket         = $this->input->post('ket', true);

        if (!$this->jabatan->validate()) {
            $array = [
                'error' => true,
                'statusCode' => 400,
                'nama_jabatan_error' => form_error('nama_jabatan'),
                'id_divisi_error'    => form_error('id_divisi')
            ];

            echo json_encode($array);
        } else {
            $data = [
                'nama_jabatan'   => $nama_jabatan,
                'id_divisi'      => $id_divisi,
                'ket'            => $ket
            ];

            if ($this->jabatan->where('id', $id)->update($data)) {
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
            if ($this->jabatan->where('id', $id)->delete()) {
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

/* End of file Jabatan.php */
