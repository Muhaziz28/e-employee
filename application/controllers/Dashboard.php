<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{


    public function __construct()
    {

        parent::__construct();
        $role = $this->session->userdata('role');

        $this->dashboard->table = 'cuti';
        $jumlahNotif = $this->dashboard->where('status_notif', 0)->orderBy('created_at', 'DESC')->limit(4)->count();

        if ($jumlahNotif > 0) {
            $array = array(
                'jumlahNotif' => $jumlahNotif
            );

            $this->session->set_userdata($array);
        } else {
            $this->session->unset_userdata('jumlahNotif');
        }

        if ($role != 'hrd') {
            redirect(base_url());
            return;
        }
    }


    public function index()
    {

        //grafik jumlah pegawai
        $this->dashboard->table     = 'pegawai';
        $data['countPegawai']       = $this->dashboard->where('is_out', 1)->count();

        $this->dashboard->table     = 'pegawai_out';
        $data['countPegawaiOut']    = $this->dashboard->count();

        $this->dashboard->table     = 'cuti';
        $data['countCuti']          = $this->dashboard->count();
        $data['countPendingCuti']   = $this->dashboard->where('status_cuti', 'pending')->count();

        $this->dashboard->table     = 'lokasi';
        $data['lokasi'] = $this->dashboard->get();


        foreach ($data['lokasi'] as $row) {
            $this->dashboard->table = 'pegawai';
            $data['count'][$row->id] = $this->dashboard->where('is_out', 1)->where('pegawai.id_lokasi', $row->id)->count();
        }

        $data['male']            = $this->dashboard->where('is_out', 1)->where('jenis_kelamin', 'Laki-laki')->count();
        $data['female']          = $this->dashboard->where('is_out', 1)->where('jenis_kelamin', 'Perempuan')->count();



        //grafik cuti
        $this->dashboard->table  = 'cuti';
        $data['countPending']    = $this->dashboard->where('status_cuti', 'pending')->count();
        $data['countDiterima']   = $this->dashboard->where('status_cuti', 'diterima')->count();
        $data['countDitolak']    = $this->dashboard->where('status_cuti', 'ditolak')->count();




        //pengajuan cuti
        $data['cuti'] = $this->dashboard->select([
            'pegawai.image', 'pegawai.nama', 'cuti.created_at AS tgl', 'cuti.id', 'cuti.status_cuti'
        ])
            ->joinPegawai('pegawai')->orderBy('cuti.created_at', 'DESC')->limit(4)->get();

        $this->dashboard->table  = 'v_umur_pegawai';
        //17 - 29
        $data['umur1729']            = $this->dashboard->where('umur >=', 17)->where('umur <=', 29)->count();
        $data['umur3049']            = $this->dashboard->where('umur >=', 30)->where('umur <=', 49)->count();
        $data['umur5065']            = $this->dashboard->where('umur >=', 50)->where('umur <=', 65)->count();

        $data['title']              = 'Dashboard';
        $data['nav_title']          = 'dashboard';
        $data['detail_title']       = 'dashboard';
        $data['page']               = 'pages/dashboard/index';




        $this->view($data);
    }
}

/* End of file Dashboard.php */
