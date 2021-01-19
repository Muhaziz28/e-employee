<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends MY_Controller
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
        $data['content']        = $this->pegawai->where('is_out', 1)->join('divisi')->join('jabatan')->get();
        $data['title']          = 'Pegawai - Daftar Pegawai';
        $data['nav_title']      = 'pegawai';
        $data['detail_title']   = 'pegawai';
        $data['page']           = 'pages/pegawai/index';

        $this->view($data);
    }

    public function list_pegawai($page = null)
    {
        $data['content']        = $this->pegawai->where('is_out', 1)->join('divisi')->join('jabatan')->paginate($page)->get();
        $data['total_rows']     = $this->pegawai->where('is_out', 1)->join('divisi')->join('jabatan')->count();
        $data['pagination']     = $this->pegawai->makePagination(base_url('pegawai/list_pegawai'), 3, $data['total_rows']);

        $this->load->view('pages/pegawai/list_pegawai', $data);
    }

    public function search($keyword, $page = null)
    {
        $data['content']        = $this->pegawai->where('is_out', 1)->join('divisi')->join('jabatan')
            ->like('pegawai.nama', urldecode($keyword))

            ->paginate($page)
            ->get();

        $data['total_rows']     = $this->pegawai->where('is_out', 1)->join('divisi')->join('jabatan')
            ->like('pegawai.nama', urldecode($keyword))


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

        $this->pegawai->table       = 'lokasi';
        $data['lokasi']             = $this->pegawai->get();

        $data['title']              = 'Form Tambah Pegawai';
        $data['sub_title']          = 'Isi form di bawah ini untuk menambahkan data pegawai.';
        $data['nav_title']          = 'pegawai';
        $data['detail_title']       = 'tambah_pegawai';
        $data['random_password']    = random_password();

        $data['form_action']        = base_url('pegawai/insert');
        $data['page']               = 'pages/pegawai/form';
        $this->view($data);
    }

    public function edit($nip)
    {
        $data['input']              = $this->pegawai->join('divisi')
            ->join('jabatan')
            ->join('level')
            ->where('pegawai.nip', $nip)
            ->first();

        $this->pegawai->table       = 'divisi';
        $data['divisi']             = $this->pegawai->get();

        $this->pegawai->table       = 'jabatan';
        $data['jabatan']            = $this->pegawai->get();

        $this->pegawai->table       = 'level';
        $data['level']              = $this->pegawai->get();

        $this->pegawai->table       = 'lokasi';
        $data['lokasi']             = $this->pegawai->get();


        $data['title']              = 'Form Edit Pegawai';
        $data['sub_title']          = 'Isi form di bawah ini untuk mengedit data pegawai.';
        $data['nav_title']          = 'pegawai';
        $data['detail_title']       = '';


        $data['form_action']        = base_url('pegawai/update');
        $data['page']               = 'pages/pegawai/form_edit';
        $this->view($data);
        //print_r($data['input']);
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
                'id_level_error'        => form_error('id_level'),
                'id_lokasi_error'       => form_error('id_lokasi')

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
                'id_lokasi'         => $this->input->post('id_lokasi', true),
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

    public function update()
    {
        $nip           = $this->input->post('nip', true);
        $image         = $this->input->post('image_pegawai', true);
        $imageTemp     = $this->input->post('image_pegawai_temp', true);
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
                'id_level_error'        => form_error('id_level'),
                'id_lokasi_error'       => form_error('id_lokasi')

            );

            echo json_encode($array);
        } else {
            $data = array(
                'nip'               => $nip,
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
                'id_lokasi'         => $this->input->post('id_lokasi', true),
                'image'             => $image

            );

            if ($this->pegawai->where('nip', $nip)->update($data)) {

                if ($imageTemp != $image) {
                    $this->pegawai->deleteImage($imageTemp);
                }

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

    public function destroy($nip)
    {
        if ($this->input->is_ajax_request()) {
            if ($this->pegawai->where('nip', $nip)->delete()) {
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




    public function detail($nip)
    {
        $data['title']      = 'Lihat Detail Pegawai';
        $data['content']    = $this->pegawai->join('divisi')
            ->join('jabatan')
            ->join('level')
            ->where('nip', $nip)
            ->first();

        //print_r($data['content']);

        $this->output->set_output(show_my_modal('pages/pegawai/modal/modal_detail_pegawai', 'modal-detail-pegawai', $data, 'lg'));
    }


    /*
    * show modal pegawai out
    *
    *
    */
    public function showModalToPegawaiOut($nip)
    {
        $data['pegawai'] = $this->pegawai->select([
            'pegawai.nip', 'pegawai.nama', 'pegawai.id_divisi', 'pegawai.id_jabatan', 'divisi.id AS id_divisi',
            'jabatan.id AS id_jabatan',
            'divisi.nama_divisi', 'jabatan.nama_jabatan'
        ])
            ->join('divisi')
            ->join('jabatan')
            ->where('nip', $nip)
            ->first();

        $data['nip'] = $nip;

        $this->output->set_output(show_my_modal('pages/pegawai/modal/modal_to_pegawai_out', 'modal-to-pegawai-out', $data, 'lg'));
    }

    public function moveToPegawaiOut($nip)
    {

        $pegawai = $this->pegawai->where('nip', $nip)->first();
        $status_out = $this->input->post('status_out', true);
        $keterangan = $this->input->post('keterangan', true);

        $data = array(
            'nip'               => $pegawai->nip,
            'nama'              => $pegawai->nama,
            'email'             => $pegawai->email,
            'tempat_lahir'      => $pegawai->tempat_lahir,
            'tgl_lahir'         => $pegawai->tgl_lahir,
            'nohp'              => $pegawai->nohp,
            'jenis_kelamin'     => $pegawai->jenis_kelamin,
            'agama'             => $pegawai->agama,
            'status'            => $pegawai->status,
            'pendidikan'        => $pegawai->pendidikan,
            'status_pegawai'    => $pegawai->status_pegawai,
            'alamat'            => $pegawai->alamat,
            'tgl_masuk'         => $pegawai->tgl_masuk,
            'durasi_kerja'      => $pegawai->durasi_kerja,
            'satuan_durasi'     => $pegawai->satuan_durasi,
            'id_divisi'         => $pegawai->id_divisi,
            'id_jabatan'        => $pegawai->id_jabatan,
            'id_level'          => $pegawai->id_level,
            'id_lokasi'         => $pegawai->id_lokasi,
            'image'             => $pegawai->image,
            'jatah_cuti'        => $pegawai->jatah_cuti,
            'password'          => $pegawai->password,
            'password_generator' => $pegawai->password_generator,
            'status_out'        => $status_out,
            'keterangan'        => $keterangan

        );


        $this->pegawai->table = 'pegawai_out';
        if ($this->pegawai->add($data) == true) {
            $this->pegawai->table = 'pegawai';

            $data_update = array(
                'is_out'    => 0
            );

            $this->pegawai->where('nip', $nip)->update($data_update);

            echo json_encode(array(
                'statusCode'    => 200
            ));
        } else {
            echo json_encode(array(
                'statusCode'    => 400
            ));
        }
    }

    public function out()
    {
        $data['title']          = 'Pegawai - Daftar Pegawai Out';
        $data['nav_title']      = 'pegawai';
        $data['detail_title']   = 'pegawai_out';
        $data['page']           = 'pages/pegawai/out';

        $this->view($data);
    }

    public function list_pegawai_out($page = null)
    {
        $this->pegawai->table = 'pegawai_out';
        $data['content']        = $this->pegawai->join('divisi')->join('jabatan')->paginate($page)->get();
        $data['total_rows']     = $this->pegawai->join('divisi')->join('jabatan')->count();
        $data['pagination']     = $this->pegawai->makePagination(base_url('pegawai/list_pegawai_out'), 3, $data['total_rows']);

        $this->load->view('pages/pegawai/list_pegawai_out', $data);
    }

    public function search_out($keyword, $page = null)
    {
        $this->pegawai->table = 'pegawai_out';
        $data['content']        = $this->pegawai->join('divisi')->join('jabatan')
            ->like('pegawai_out.nama', urldecode($keyword))

            ->paginate($page)
            ->get();

        $data['total_rows']     = $this->pegawai->join('divisi')->join('jabatan')
            ->like('pegawai_out.nama', urldecode($keyword))


            ->count();

        $data['pagination']     = $this->pegawai->makePagination(
            base_url("pegawai/search_out/" . urldecode($keyword)),
            4,
            $data['total_rows']
        );

        $this->load->view('pages/pegawai/list_pegawai_out', $data);
    }

    public function masukPegawai($nip)
    {
        $this->pegawai->table = 'pegawai';

        if ($nip) {
            $this->pegawai->where('nip', $nip)->update(['is_out' => 1]);
            $this->pegawai->table = 'pegawai_out';
            if ($this->pegawai->where('nip', $nip)->delete()) {
                echo json_encode(array(
                    'statusCode'   => 200
                ));
            } else {
                echo json_encode(array(
                    'statusCode'    => 400
                ));
            }
        }
    }

    public function exportToExcel($jenis_pegawai)
    {

        $this->pegawai->table = 'pegawai';
        if ($jenis_pegawai == "pegawai") {
            $pegawai    = $this->pegawai->where('is_out', 1)->join('divisi')->join('jabatan')->join('level')->join('lokasi')->get();
        } else {
            $this->pegawai->table = 'pegawai_out';
            $pegawai    = $this->pegawai->get();
        }

        if ($pegawai) {
            include_once APPPATH . '/third_party/xlsxwriter.class.php';
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE);

            if ($jenis_pegawai == "pegawai") {
                $filename = "data-pegawai-" . date('d-m-Y-His') . ".xlsx";
            } else {
                $filename = "data-pegawai-out-" . date('d-m-Y-His') . ".xlsx";
            }
            header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');

            $styles = array(
                'widths' => [7, 30, 25, 38, 17, 25, 19, 20, 28, 29, 55, 30, 20, 27, 27, 20, 20, 20, 20],
                'heights' => [21],
                'font' => 'Arial', 'font-size' => 12,
                'font-style' => 'bold',
                'fill' => '#eee',
                'halign' => 'center',
                'border' => 'left,right,top,bottom',
                'border-style'  => 'thin'
            );

            $styles2 = array(
                [
                    'font' => 'Arial', 'font-size' => 11,
                    'halign' => 'left',
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],


            );

            $header = array(
                'No'                        => 'integer',
                'NIP'                       => 'string',
                'Nama Pegawai'              => 'string',
                'Email'                     => 'string',
                'Tempat Lahir'              => 'string',
                'Tgl Lahir'                 => 'dd/mm/yyyy',
                'Jenis Kelamin'             => 'string',
                'Agama'                     => 'string',
                'Status'                    => 'string',
                'Status Pegawai'            => 'string',
                'Alamat'                    => 'string',
                'No HP'                     => 'string',
                'Pendidikan'                => 'string',
                'Divisi'                    => 'string',
                'Jabatan'                   => 'string',
                'Level'                     => 'string',
                'Penempatan'                => 'string',
                'Tgl Masuk'                 => 'dd/mm/yyyy',
                'Durasi Kerja'              => 'string',


            );

            $writer = new XLSXWriter();
            $writer->setAuthor('admin');

            $writer->writeSheetHeader('Pegawai', $header, $styles);

            $no = 1;

            foreach ($pegawai as $row) {

                if ($row->durasi_kerja != null) {
                    if ($row->satuan_durasi == "year") {
                        $satuan_durasi = "tahun";
                    } else if ($row->satuan_durasi == "month") {
                        $satuan_durasi = "bulan";
                    } else if ($row->satuan_durasi == null) {
                        $satuan_durasi = "";
                    }
                }


                $writer->writeSheetRow(

                    'Pegawai',
                    [
                        $no,
                        $row->nip,
                        $row->nama,
                        $row->email,
                        $row->tempat_lahir,
                        $row->tgl_lahir,
                        $row->jenis_kelamin,
                        $row->agama,
                        $row->status,
                        $row->status_pegawai,
                        $row->alamat,
                        $row->nohp,
                        $row->pendidikan,
                        $row->nama_divisi,
                        $row->nama_jabatan,
                        $row->nama_level,
                        $row->nama_lokasi,
                        $row->tgl_masuk,
                        $row->durasi_kerja != '' ? $row->durasi_kerja . ' ' . $satuan_durasi : ""



                    ],
                    $styles2





                );


                $no++;
            }
            $writer->writeToStdOut();
        } else {
        }
    }
}

/* End of file Pegawai.php */
