<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mykpi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');

        $this->load->library('mypdf');


        if ($is_login != true) {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['title']          = 'KPI - Daftar Nilai KPI Pegawai';
        $data['nav_title']      = 'mykpi';
        $data['detail_title']   = '';

        $this->mykpi->table      = 'pegawai';
        $data['getPegawai']     = $this->mykpi->select([
            'pegawai.nama', 'pegawai.nip', 'jabatan.nama_jabatan', 'divisi.nama_divisi', 'lokasi.nama_lokasi',
            'kpi.kehadiran', 'kpi.kinerja', 'kpi.created_at'
        ])
            ->join('jabatan')
            ->join('divisi')
            ->join('lokasi')
            ->joinKpi('kpi')
            ->where('pegawai.is_out', 1)
            ->get();

        $data['page']           = 'pages/mykpi/index';

        //print_r($data['getPegawai']);
        $this->view($data);
    }

    public function loadTable($month = null, $year = null)
    {
        $this->mykpi->table      = 'pegawai';

        if ($month == null && $year == null) {
            $data['getPegawai']     = $this->mykpi->select([
                'pegawai.nama', 'pegawai.nip', 'jabatan.nama_jabatan', 'divisi.nama_divisi', 'lokasi.nama_lokasi',
                'kpi.kehadiran', 'kpi.kinerja', 'kpi.created_at'
            ])
                ->join('jabatan', 'inner')
                ->join('divisi', 'inner')
                ->join('lokasi', 'inner')
                ->joinKpi('kpi', 'inner')
                ->where('pegawai.is_out', 1)
                ->where('kpi.nip_pegawai', $this->session->userdata('nip'))
                ->orderBy('kpi.created_at', 'DESC')
                ->get();
        } else {
            $data['getPegawai']     = $this->mykpi->select([
                'pegawai.nama', 'pegawai.nip', 'jabatan.nama_jabatan', 'divisi.nama_divisi', 'lokasi.nama_lokasi',
                'kpi.kehadiran', 'kpi.kinerja', 'kpi.created_at'
            ])
                ->join('jabatan', 'inner')
                ->join('divisi', 'inner')
                ->join('lokasi', 'inner')
                ->joinKpi('kpi', 'inner')
                ->where('pegawai.is_out', 1)
                ->where('kpi.nip_pegawai', $this->session->userdata('nip'))
                ->where('MONTH(kpi.created_at)', $month)
                ->where('YEAR(kpi.created_at)', $year)
                ->orderBy('kpi.created_at', 'DESC')
                ->get();
        }

        $this->load->view('pages/mykpi/table_ajax', $data);
    }
}

/* End of file Mykpi.php */
