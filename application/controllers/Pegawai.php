<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends MY_Controller
{

    public function index()
    {
        $data['content']        = $this->pegawai->join('divisi')->join('jabatan')->get();
        $data['title']          = 'Pegawai - Daftar Pegawai';
        $data['nav_title']      = 'pegawai';
        $data['detail_title']   = 'pegawai';
        $data['page']           = 'pages/pegawai/index';

        $this->view($data);
    }

    public function list_pegawai($page = null)
    {
        $data['content']        = $this->pegawai->join('divisi')->join('jabatan')->paginate($page)->get();
        $data['total_rows']     = $this->pegawai->join('divisi')->join('jabatan')->count();
        $data['pagination']     = $this->pegawai->makePagination(base_url('pegawai/list_pegawai'), 3, $data['total_rows']);

        $this->load->view('pages/pegawai/list_pegawai', $data);
    }

    public function search($keyword, $page = null)
    {
        $data['content']        = $this->pegawai->join('divisi')->join('jabatan')
            ->like('pegawai.nama', urldecode($keyword))
            ->orLike('pegawai.nip', urldecode($keyword))
            ->orLike('divisi.nama_divisi', urldecode($keyword))
            ->paginate($page)
            ->get();

        $data['total_rows']     = $this->pegawai->join('divisi')->join('jabatan')
            ->like('pegawai.nama', urldecode($keyword))
            ->orLike('pegawai.nip', urldecode($keyword))

            ->count();

        $data['pagination']     = $this->pegawai->makePagination(
            base_url("pegawai/search/" . urldecode($keyword)),
            4,
            $data['total_rows']
        );

        $this->load->view('pages/pegawai/list_pegawai', $data);
    }

    public function add()
    {

        $this->pegawai->table       = 'divisi';
        $data['divisi']             = $this->pegawai->get();

        $this->pegawai->table       = 'level';
        $data['level']              = $this->pegawai->get();


        $data['title']              = 'Form Tambah Pegawai';
        $data['sub_title']          = 'Isi form di bawah ini untuk menambahkan data pegawai.';
        $data['nav_title']          = 'pegawai';
        $data['detail_title']       = 'tambah_pegawai';
        $data['random_password']    = random_password();

        $data['form_action']        = base_url('pegawai/insert');
        $data['page']               = 'pages/pegawai/form';
        $this->view($data);
    }

    public function insert()
    {

        $durasi_kerja  = $this->input->post('durasi_kerja', true);
        $satuan_durasi = $this->input->post('satuan_durasi', true);


        if (!$this->pegawai->validate()) {
            $array = array(
                'error'                 => true,
                'statusCode'            => 400,
                'nama_error'            => form_error('nama'),
                'email_error'           => form_error('email'),
                'tempat_lahir_error'    => form_error('tempat_lahir'),
                'tgl_lahir_error'       => form_error('tgl_lahir'),
                'nohp_error'            => form_error('nohp'),
                'jenis_kelamin_error'   => form_error('jenis_kelamin'),
                'agama_error'           => form_error('agama'),
                'status_error'          => form_error('status'),
                'pendidikan_error'      => form_error('pendidikan'),
                'status_pegawai_error'  => form_error('status_pegawai'),
                'alamat_error'          => form_error('alamat'),
                'tgl_masuk_error'       => form_error('tgl_masuk'),
                'id_divisi_error'       => form_error('id_divisi'),
                'id_jabatan_error'      => form_error('id_jabatan'),
                'id_level_error'        => form_error('id_level')

            );

            echo json_encode($array);
        } else {
            $data = array(
                'nip'               => $this->input->post('nip', true),
                'nama'              => $this->input->post('nama', true),
                'email'             => $this->input->post('email', true),
                'tempat_lahir'      => $this->input->post('tempat_lahir', true),
                'tgl_lahir'         => $this->input->post('tgl_lahir', true),
                'nohp'              => $this->input->post('nohp', true),
                'jenis_kelamin'     => $this->input->post('jenis_kelamin', true),
                'agama'             => $this->input->post('agama', true),
                'status'            => $this->input->post('status', true),
                'pendidikan'        => $this->input->post('pendidikan', true),
                'status_pegawai'    => $this->input->post('status_pegawai', true),
                'alamat'            => $this->input->post('alamat', true),
                'tgl_masuk'         => $this->input->post('tgl_masuk', true),
                'durasi_kerja'      => $durasi_kerja,
                'satuan_durasi'     => $satuan_durasi,
                'id_divisi'         => $this->input->post('id_divisi', true),
                'id_jabatan'        => $this->input->post('id_jabatan', true),
                'id_level'          => $this->input->post('id_level', true),
                'image'             => $this->input->post('image_pegawai', true),
                'password'          => hashEncrypt($this->input->post('password_generator'), true),
                'password_generator' => $this->input->post('password_generator', true)
            );

            if ($this->pegawai->add($data) == true) {
                echo json_encode(array(
                    'statusCode'    => 200
                ));
            } else {
                echo json_encode(array(
                    'statusCode'    => 201
                ));
            }
        }
    }

    public function showNipMax($jenis_kelamin)
    {
        $nipMax = getNipMax($jenis_kelamin);

        echo json_encode($nipMax);
    }

    public function generatorPass()
    {
        echo random_password();
    }

    public function formSelectJabatan($id)
    {
        $this->pegawai->table = 'jabatan';
        $option = '';

        $jabatan = $this->pegawai->where('id_divisi', $id)->get();

        $option .= '<option value="">- Pilih Jabatan -</option>';
        foreach ($jabatan as $row) {
            $option .= '<option value="' . $row->id . '">' . $row->nama_jabatan . '</option>';
        }

        echo $option;
    }

    public function uploadProfileImage($nama_pegawai)
    {
        if (isset($_POST['image'])) {
            $data       = $_POST['image'];

            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $imageName = url_title($nama_pegawai, '-', true) . '-' . date('YmdHis') . '.png';

            file_put_contents('./images/pegawai/' . $imageName, $data);

            echo json_encode(array(
                'image_name'  => $imageName,
                'show_image'  => '<img src="' . base_url("images/pegawai/$imageName") . '" class="img-thumbnail img-pegawai">'
            ));
        }
    }


    public function tes()
    {
        $date = new DateTime("2020-12-19");
        $durasi = 2;
        $jenis = 'year';
        $date->modify("+$durasi $jenis");
        $tanggal_rencana = $date->format('Y-m-d');

        echo $tanggal_rencana;
    }


    public function detail($id)
    {
        $data['title']      = 'Lihat Detail Pegawai';
        $data['content']    = $this->pegawai->join('divisi')
            ->join('jabatan')
            ->join('level')
            ->where('nip', $id)
            ->first();

        //print_r($data['content']);

        $this->output->set_output(show_my_modal('pages/pegawai/modal/modal_detail_pegawai', 'modal-detail-pegawai', $data, 'lg'));
    }
}

/* End of file Pegawai.php */
