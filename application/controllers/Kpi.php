<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kpi extends MY_Controller
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
        $data['title']          = 'KPI - Daftar Nilai KPI Pegawai';
        $data['nav_title']      = 'kpi';
        $data['detail_title']   = 'daftar_kpi';

        $this->kpi->table      = 'pegawai';
        $data['getPegawai']     = $this->kpi->select([
            'pegawai.nama', 'pegawai.nip', 'jabatan.nama_jabatan', 'divisi.nama_divisi', 'lokasi.nama_lokasi',
            'kpi.kehadiran', 'kpi.kinerja', 'kpi.created_at'
        ])
            ->join('jabatan')
            ->join('divisi')
            ->join('lokasi')
            ->joinKpi('kpi')
            ->where('pegawai.is_out', 1)
            ->get();

        $data['page']           = 'pages/kpi/index';

        //print_r($data['getPegawai']);
        $this->view($data);
    }

    public function loadTable($month = null, $year = null)
    {
        $this->kpi->table      = 'pegawai';

        if ($month == null && $year == null) {
            $data['getPegawai']     = $this->kpi->select([
                'pegawai.nama', 'pegawai.nip', 'jabatan.nama_jabatan', 'divisi.nama_divisi', 'lokasi.nama_lokasi',
                'kpi.kehadiran', 'kpi.kinerja', 'kpi.created_at'
            ])
                ->join('jabatan', 'inner')
                ->join('divisi', 'inner')
                ->join('lokasi', 'inner')
                ->joinKpi('kpi', 'inner')
                ->where('pegawai.is_out', 1)
                ->where('MONTH(kpi.created_at)', date("m"))
                ->where('YEAR(kpi.created_at)', date("Y"))
                ->orderBy('kpi.created_at', 'DESC')
                ->get();
        } else {
            $data['getPegawai']     = $this->kpi->select([
                'pegawai.nama', 'pegawai.nip', 'jabatan.nama_jabatan', 'divisi.nama_divisi', 'lokasi.nama_lokasi',
                'kpi.kehadiran', 'kpi.kinerja', 'kpi.created_at'
            ])
                ->join('jabatan', 'inner')
                ->join('divisi', 'inner')
                ->join('lokasi', 'inner')
                ->joinKpi('kpi', 'inner')
                ->where('pegawai.is_out', 1)
                ->where('MONTH(kpi.created_at)', $month)
                ->where('YEAR(kpi.created_at)', $year)
                ->orderBy('kpi.created_at', 'DESC')
                ->get();
        }

        $this->load->view('pages/kpi/table_ajax', $data);
    }

    public function nilai()
    {
        $data['title']          = 'KPI - Tambah Nilai KPI Pegawai';
        $data['nav_title']      = 'kpi';
        $data['detail_title']   = 'tambah_kpi';

        $this->kpi->table      = 'pegawai';
        $data['getPegawai']     = $this->kpi->where('is_out', 1)->get();
        $data['page']           = 'pages/kpi/nilai/index';

        $this->view($data);
    }

    public function showPegawaiNilaiKpi()
    {
        $this->kpi->table      = 'pegawai';
        $data['getPegawai']     = $this->kpi->where('is_out', 1)->orderBy('created_at', 'DESC')->get();
        echo $this->load->view('pages/kpi/nilai/nilai', $data, true);
    }

    public function formTambahNilaiKpi($nip)
    {
        $this->kpi->table      = 'pegawai';
        $data['pegawai']        = $this->kpi->where('pegawai.nip', $nip)->join('jabatan')->join('divisi')
            ->joinGaji('gaji')->first();

        $this->kpi->table       = 'kpi';
        $data['kpi']            = $this->kpi->where('kpi.nip_pegawai', $nip)
            ->where('MONTH(kpi.created_at)', date("m"))
            ->where('YEAR(kpi.created_at)', date("Y"))
            ->first();

        $this->load->view('pages/kpi/nilai/form_tambah_nilai_kpi', $data);
    }

    public function editFormTambahNilaiKpi($id)
    {
        $this->kpi->table      = 'kpi';
        $data['edit_kpi']      = $this->kpi->where('kpi.id', $id)
            ->first();

        $this->load->view('pages/kpi/nilai/form_edit_nilai_kpi', $data);
    }

    public function insert()
    {
        $kehadiran    = $this->input->post('kehadiran', true);
        $kinerja      = $this->input->post('kinerja', true);
        $nip_pegawai  = $this->input->post('nip_pegawai', true);


        if (!$this->kpi->validate()) {
            $array = array(
                'error'             => true,
                'statusCode'        => 400,
                'kehadiran_error'   => form_error('kehadiran'),
                'kinerja_error'     => form_error('kinerja')
            );

            echo json_encode($array);
        } else {
            $data = array(
                'id'                => date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1),
                'nip_pegawai'       => $nip_pegawai,
                'kehadiran'         => strtoupper($kehadiran),
                'kinerja'           => strtoupper($kinerja)
            );

            if ($this->kpi->add($data) == true) {
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
        $id           = $this->input->post('id', true);
        $kehadiran    = $this->input->post('kehadiran', true);
        $kinerja      = $this->input->post('kinerja', true);
        $nip_pegawai  = $this->input->post('nip_pegawai', true);


        if (!$this->kpi->validate()) {
            $array = array(
                'error'             => true,
                'statusCode'        => 400,
                'kehadiran_error'   => form_error('kehadiran'),
                'kinerja_error'     => form_error('kinerja')
            );

            echo json_encode($array);
        } else {
            $data = array(
                'nip_pegawai'       => $nip_pegawai,
                'kehadiran'         => $kehadiran,
                'kinerja'           => $kinerja
            );

            if ($this->kpi->where('kpi.id', $id)->update($data)) {
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

    public function only_alphabet_kehadiran()
    {
        $kehadiran = $this->input->post('kehadiran', true);

        if ($kehadiran != '') {
            if (!preg_match("/^[a-fA-F]*$/", $kehadiran)) {
                $this->load->library('form_validation');
                $this->form_validation->set_message('only_alphabet_kehadiran', '%s harus berisi A - F');
                return false;
            } else {
                return true;
            }
        }
    }

    public function only_alphabet_kinerja()
    {
        $kinerja = $this->input->post('kinerja', true);

        if ($kinerja != '') {
            if (!preg_match("/^[a-fA-F]*$/", $kinerja)) {
                $this->load->library('form_validation');
                $this->form_validation->set_message('only_alphabet_kinerja', '%s harus berisi A - F');
                return false;
            } else {
                return true;
            }
        }
    }
}

/* End of file Kpi.php */
