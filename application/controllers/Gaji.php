<?php


defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Gaji extends MY_Controller
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
        $data['title']          = 'Gaji - Daftar Gaji Pegawai';
        $data['nav_title']      = 'gaji';
        $data['detail_title']   = 'daftar_gaji';

        $this->gaji->table      = 'pegawai';
        $data['getPegawai']     = $this->gaji->where('is_out', 1)->get();
        $data['page']           = 'pages/gaji/index';

        $this->view($data);
    }

    public function onChangeGrade($id_grade)
    {
        $this->gaji->table = 'grade';
        $grade             = $this->grade->where('id', $id_grade)->first();

        if ($grade) {
            echo json_encode([
                'statusCode'                    => 200,
                'gaji_pokok'                    => $grade->gaji_pokok,
                'tunjangan_kehadiran'           => $grade->tunjangan_kehadiran,
                'tunjangan_operasional'         => $grade->tunjangan_operasional,
            ]);
        } else {
            echo json_encode([
                'statusCode'                    => 201
            ]);
        }
    }

    public function showForm($nip, $divisi)
    {
        $this->gaji->table = 'pegawai';
        $data['pegawai']  = $this->gaji->where('nip', $nip)->first();
        $data['title']     = 'Form Tambah Gaji (' . $data['pegawai']->nama . ')';
        $data['nip']       = $nip;




        $this->gaji->table = 'grade';
        $data['getGrade']   = $this->gaji->where('id_level', $data['pegawai']->id_level)->get();

        $id_grade_peg = $data['pegawai']->id_grade;
        $data['divisi'] = $divisi;

        if ($id_grade_peg != null || $id_grade_peg != "") {
            $data['grade']      = $this->gaji->where('id', $id_grade_peg)->first();
        }
        $this->output->set_output(show_my_modal('pages/gaji/modal/modal_add_form', 'modal-add-gaji', $data, 'lg'));
    }

    public function showFormEdit($id)
    {
        $data['title']     = 'Form Edit Gaji';

        $this->gaji->table = 'pegawai';
        $data['getGaji']   = $this->gaji
            ->joinGaji('gaji')
            ->where('gaji.id', $id)
            ->first();

        $this->gaji->table = 'grade';
        $data['getGrade']   = $this->gaji->where('id_level', $data['getGaji']->id_level)->get();
        $this->output->set_output(show_my_modal('pages/gaji/modal/modal_edit_form', 'modal-edit-gaji', $data, 'lg'));
    }

    public function loadTable()
    {

        $category_peg = $this->input->get('peg', true);

        if ($category_peg == "" || $category_peg == "Soraya Bedsheet") {
            $this->gaji->table      = 'pegawai';
            $data['content']        = $this->gaji->select([
                'pegawai.nip', 'pegawai.nama', 'jabatan.nama_jabatan', 'gaji.jumlah_gaji', 'gaji.id AS id_gaji',
                'pegawai.id_lokasi', 'pegawai.id_divisi'
            ])
                ->where('pegawai.is_out', 1)
                ->where('pegawai.id_divisi !=', 21)
                ->join('jabatan')
                ->joinGaji('gaji')
                ->orderBy('pegawai.created_at', 'DESC')
                ->get();
            $this->load->view('pages/gaji/table_ajax', $data);
        } else {
            $this->gaji->table      = 'pegawai';
            $data['content']        = $this->gaji->select([
                'pegawai.nip', 'pegawai.nama', 'jabatan.nama_jabatan', 'gaji.jumlah_gaji', 'gaji.id AS id_gaji',
                'pegawai.id_lokasi', 'pegawai.id_divisi'
            ])
                ->where('pegawai.is_out', 1)
                ->where('pegawai.id_divisi', 21)
                ->join('jabatan')
                ->joinGaji('gaji')
                ->orderBy('pegawai.created_at', 'DESC')
                ->get();
            $this->load->view('pages/gaji/table_ajax', $data);
        }
    }


    public function insert()
    {
        $divisi_peg  = $this->input->post('divisi_peg', true);

        if ($divisi_peg != 21) {
            $jumlah_gaji = $this->input->post('jumlah_gaji', true);
            $nip_pegawai = $this->input->post('nip_pegawai', true);
            $id_grade = $this->input->post('id_grade', true);
            $insentif_kehadiran = $this->input->post('insentif_kehadiran', true);
            $tunjangan   = $this->input->post('tunjangan', true);
            $tunjangan_kerajinan = $this->input->post('tunjangan_kerajinan', true);
            //convert to int
            $gaji_conv = (int) str_replace(".", "", $jumlah_gaji);
            $insentif_conv = (int) str_replace(".", "", $insentif_kehadiran);
            $tunjangan_conv = (int) str_replace(".", "", $tunjangan);
            $tunjangan_kerajinan_conv = (int) str_replace(".", "", $tunjangan_kerajinan);


            if (!$this->gaji->validate()) {
                $array = array(
                    'error' => true,
                    'statusCode' => 400,
                    'divisiPeg'     => $divisi_peg,
                    'jumlah_gaji_error' => form_error('jumlah_gaji'),
                    'insentif_kehadiran_error'  => form_error('insentif_kehadiran'),
                    'tunjangan_error'       => form_error('tunjangan'),
                    'tunjangan_kerajinan_error' => form_error('tunjangan_kerajinan')
                );

                echo json_encode($array);
            } else {
                $data = [
                    'id'                => date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1),
                    'nip_pegawai'       => $nip_pegawai,
                    'gaji'              => $gaji_conv,
                    'insentif_kehadiran' => $insentif_conv,
                    'tunjangan'         => $tunjangan_conv,
                    'tunjangan_kerajinan' => $tunjangan_kerajinan_conv,
                    'jumlah_gaji'       => $gaji_conv + $insentif_conv + $tunjangan_conv + $tunjangan_kerajinan_conv
                ];

                if ($this->gaji->add($data) == true) {

                    $this->gaji->table = 'pegawai';
                    $this->gaji->where('nip', $nip_pegawai)->update([
                        'id_grade'      => $id_grade,
                    ]);
                    echo json_encode(array(
                        'statusCode'    => 200,
                        'divisiPeg'     => $divisi_peg
                    ));
                } else {
                    echo json_encode(array(
                        'statusCode'    => 201
                    ));
                }
            }
        } else {
            $nip_pegawai = $this->input->post('nip_pegawai', true);
            $jumlah_gaji = $this->input->post('jumlah_gaji', true);
            $tunjangan_leader = $this->input->post('tunjangan_leader', true);
            $tunjangan_kebersihan = $this->input->post('tunjangan_kebersihan', true);
            $tunjangan_keamanan = $this->input->post('tunjangan_keamanan', true);
            $tunjangan_dokter = $this->input->post('tunjangan_dokter', true);
            $tunjangan_lainnya = $this->input->post('tunjangan_lainnya', true);

            //convert to int
            $gaji_conv              = (int) str_replace(".", "", $jumlah_gaji);
            $leader_conv            = (int) str_replace(".", "", $tunjangan_leader);
            $kebersihan_conv        = (int) str_replace(".", "", $tunjangan_kebersihan);
            $keamanan_conv          = (int) str_replace(".", "", $tunjangan_keamanan);
            $dokter_conv            = (int) str_replace(".", "", $tunjangan_dokter);
            $lainnya_conv           = (int) str_replace(".", "", $tunjangan_lainnya);


            if (!$this->gaji->validate2()) {
                $array = array(
                    'error' => true,
                    'statusCode' => 400,
                    'divisiPeg'     => $divisi_peg,
                    'jumlah_gaji_error' => form_error('jumlah_gaji'),
                    'tunjangan_leader_error' => form_error('tunjangan_leader'),
                    'tunjangan_kebersihan_error' => form_error('tunjangan_kebersihan'),
                    'tunjangan_keamanan_error' => form_error('tunjangan_keamanan'),
                    'tunjangan_dokter_error' => form_error('tunjangan_dokter'),
                );

                echo json_encode($array);
            } else {
                $data       = [
                    'id'                => date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1),
                    'nip_pegawai'       => $nip_pegawai,
                    'gaji'              => $gaji_conv,
                    'tunjangan_leader'  => $leader_conv,
                    'tunjangan_kebersihan'  => $kebersihan_conv,
                    'tunjangan_keamanan'  => $keamanan_conv,
                    'tunjangan_dokter'  => $dokter_conv,
                    'tunjangan_lainnya'  => $lainnya_conv,
                    'jumlah_gaji'       => $gaji_conv + $leader_conv + $kebersihan_conv + $keamanan_conv + $dokter_conv + $lainnya_conv
                ];

                if ($this->gaji->add($data) == true) {
                    echo json_encode(array(
                        'statusCode'    => 200,
                        'divisiPeg'     => $divisi_peg
                    ));
                } else {
                    echo json_encode(array(
                        'statusCode'    => 201
                    ));
                }
            }
        }
    }

    public function update()
    {
        $id          = $this->input->post('id', true);
        $jumlah_gaji = $this->input->post('jumlah_gaji', true);
        $nip_pegawai = $this->input->post('nip_pegawai', true);
        $id_grade = $this->input->post('id_grade', true);
        $insentif_kehadiran = $this->input->post('insentif_kehadiran', true);
        $tunjangan   = $this->input->post('tunjangan', true);
        $tunjangan_kerajinan = $this->input->post('tunjangan_kerajinan', true);

        //convert to int
        $gaji_conv = (int) str_replace(".", "", $jumlah_gaji);
        $insentif_conv = (int) str_replace(".", "", $insentif_kehadiran);
        $tunjangan_conv = (int) str_replace(".", "", $tunjangan);
        $tunjangan_kerajinan_conv = (int) str_replace(".", "", $tunjangan_kerajinan);

        if (!$this->gaji->validate()) {
            $array = array(
                'error' => true,
                'statusCode' => 400,
                'jumlah_gaji_edit_error' => form_error('jumlah_gaji'),
                'insentif_kehadiran_edit_error'  => form_error('insentif_kehadiran'),
                'tunjangan_edit_error'       => form_error('tunjangan'),
                'tunjangan_kerajinan_edit_error'       => form_error('tunjangan_kerajinan')
            );

            echo json_encode($array);
        } else {
            $data = [
                'nip_pegawai'       => $nip_pegawai,
                'gaji'              => $gaji_conv,
                'insentif_kehadiran' => $insentif_conv,
                'tunjangan'         => $tunjangan_conv,
                'tunjangan_kerajinan' => $tunjangan_kerajinan_conv,
                'jumlah_gaji'       => $gaji_conv + $insentif_conv + $tunjangan_conv + $tunjangan_kerajinan_conv
            ];

            if ($this->gaji->where('id', $id)->update($data)) {
                $this->gaji->table = 'pegawai';
                $this->gaji->where('nip', $nip_pegawai)->update([
                    'id_grade'      => $id_grade,
                ]);
                echo json_encode(array(
                    'statusCode'    => 200,
                ));
            } else {
                echo json_encode(array(
                    'statusCode'    => 201
                ));
            }
        }
    }

    public function destroy($id)
    {

        if ($this->input->is_ajax_request()) {
            if ($this->gaji->where('id', $id)->delete()) {
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

    public function riwayat_perubahan_gaji()
    {
        $data['title']          = 'Gaji - Riwayat Perubahan Gaji Pegawai';
        $data['nav_title']      = 'gaji';
        $data['detail_title']   = 'perubahan_gaji';

        $this->gaji->table      = 'pegawai';
        $data['getPegawai']     = $this->gaji->where('is_out', 1)->get();
        $data['page']           = 'pages/gaji/riwayat_perubahan_gaji/index';

        $this->view($data);
    }

    public function showFormRiwayatPerubahanGaji()
    {
        $this->gaji->table      = 'pegawai';
        $data['getPegawai']     = $this->gaji->where('is_out', 1)->orderBy('created_at', 'DESC')->get();
        echo $this->load->view('pages/gaji/riwayat_perubahan_gaji/riwayat_perubahan_gaji', $data, true);
    }

    public function resultRiwayatPerubahanGaji($nip)
    {
        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('jabatan')->join('divisi')
            ->joinGaji('gaji')->first();


        $data['riwayat']        = $this->gaji->where('log_gaji.nip_pegawai', $nip)
            ->joinLogGaji('log_gaji')
            ->join('jabatan')
            ->orderBy('waktu_perubahan', 'DESC')
            ->get();
        $this->load->view('pages/gaji/riwayat_perubahan_gaji/result', $data);
    }

    public function view_slip_gaji()
    {
        $data['title']          = 'Gaji - Lihat Slip Gaji';
        $data['nav_title']      = 'gaji';
        $data['detail_title']   = 'view_slip_gaji';

        $this->gaji->table      = 'pegawai';
        $data['getPegawai']     = $this->gaji->where('is_out', 1)->get();
        $data['page']           = 'pages/gaji/view_slip/index';

        $this->view($data);
    }

    public function showFormViewSlipGaji()
    {
        $this->gaji->table      = 'pegawai';
        $data['getPegawai']     = $this->gaji->where('is_out', 1)->orderBy('created_at', 'DESC')->get();
        echo $this->load->view('pages/gaji/view_slip/form_pegawai', $data, true);
    }

    public function resultViewSlipGaji($nip, $month = null, $year = null)
    {

        if ($month == null && $year == null) {
            $this->gaji->table      = 'slip_gaji';
            $data['slip_gaji']        = $this->gaji->select([
                'gaji.jumlah_gaji', 'slip_gaji.total_gaji', 'slip_gaji.created_at', 'slip_gaji.id', 'slip_gaji.nip_pegawai'
            ])
                ->where('slip_gaji.nip_pegawai', $nip)

                ->join('gaji')
                ->orderBy('slip_gaji.created_at', 'DESC')
                ->get();
        } else {
            $this->gaji->table      = 'slip_gaji';
            $data['slip_gaji']        = $this->gaji->select([
                'gaji.jumlah_gaji', 'slip_gaji.total_gaji', 'slip_gaji.created_at', 'slip_gaji.id', 'slip_gaji.nip_pegawai'
            ])
                ->where('slip_gaji.nip_pegawai', $nip)
                ->where('MONTH(slip_gaji.created_at)', $month)
                ->where('YEAR(slip_gaji.created_at)', $year)
                ->join('gaji')
                ->orderBy('slip_gaji.created_at', 'DESC')
                ->get();
        }
        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('jabatan')->join('divisi')
            ->joinGaji('gaji')->first();



        $this->load->view('pages/gaji/view_slip/result', $data);
    }

    public function viewSlipGajiEmp($id, $nip)
    {
        $data['title']          = 'Slip Gaji';
        $data['emp']            = true;

        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('divisi')
            ->join('jabatan')
            ->join('lokasi')
            ->first();

        $this->gaji->table      = 'slip_gaji';
        $data['slip_gaji']      = $this->gaji->where('slip_gaji.id', $id)
            ->first();

        $this->gaji->table      = 'gaji';
        $data['gaji']           = $this->gaji->where('gaji.nip_pegawai', $nip)->first();
        $this->output->set_output(show_my_modal('pages/gaji/modal/modal_view_slip_gaji', 'modal-view-slip-gaji', $data, 'lg'));
    }

    public function slip()
    {
        $data['title']          = 'Gaji - Slip Gaji';
        $data['nav_title']      = 'gaji';
        $data['detail_title']   = 'slip_gaji';

        $this->gaji->table      = 'pegawai';
        $data['getPegawai']     = $this->gaji->where('is_out', 1)->get();
        $data['page']           = 'pages/gaji/slip/index';

        $this->view($data);
    }

    public function showFormSlip()
    {
        $this->gaji->table      = 'pegawai';
        $data['getPegawai']     = $this->gaji->where('is_out', 1)->orderBy('created_at', 'DESC')->get();
        echo $this->load->view('pages/gaji/slip/slip_gaji', $data, true);
    }

    public function formSlip($nip)
    {
        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('jabatan')->join('divisi')
            ->joinGaji('gaji')->first();

        $this->gaji->table      = 'gaji';
        $data['gaji']           = $this->gaji->where('gaji.nip_pegawai', $nip)->first();

        $this->gaji->table      = 'slip_gaji';
        $data['slip_gaji']      = $this->gaji->where('YEAR(slip_gaji.created_at)', date('Y'))->where('MONTH(slip_gaji.created_at)', date('m'))
            ->where('slip_gaji.nip_pegawai', $nip)
            ->first();

        $this->load->view('pages/gaji/slip/form_slip', $data);
    }

    public function editFormSlip($nip)
    {

        $this->gaji->table      = 'gaji';
        $data['gaji']           = $this->gaji->where('gaji.nip_pegawai', $nip)->first();


        $this->gaji->table      = 'slip_gaji';
        $data['edit_slip_gaji']      = $this->gaji->where('YEAR(slip_gaji.created_at)', date('Y'))->where('MONTH(slip_gaji.created_at)', date('m'))
            ->where('slip_gaji.nip_pegawai', $nip)
            ->first();

        $this->load->view('pages/gaji/slip/edit_form_slip', $data);
    }

    public function loadBtnAction($nip)
    {
        $this->gaji->table      = 'slip_gaji';
        $data['slip_gaji']      = $this->gaji->where('YEAR(slip_gaji.created_at)', date('Y'))->where('MONTH(slip_gaji.created_at)', date('m'))
            ->where('slip_gaji.nip_pegawai', $nip)
            ->first();

        $this->load->view('pages/gaji/slip/button_action', $data);
    }

    public function viewSlipGaji($nip)
    {
        $data['title']     = 'Slip Gaji';
        $data['emp']       = false;
        $this->gaji->table      = 'slip_gaji';
        $data['slip_gaji']      = $this->gaji->where('YEAR(slip_gaji.created_at)', date('Y'))->where('MONTH(slip_gaji.created_at)', date('m'))
            ->where('slip_gaji.nip_pegawai', $nip)
            ->first();

        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('divisi')
            ->join('jabatan')
            ->join('lokasi')
            ->first();

        $this->gaji->table      = 'gaji';
        $data['gaji']           = $this->gaji->where('gaji.nip_pegawai', $nip)->first();
        $this->output->set_output(show_my_modal('pages/gaji/modal/modal_view_slip_gaji', 'modal-view-slip-gaji', $data, 'lg'));
    }

    public function print($nip)
    {

        $this->gaji->table      = 'slip_gaji';
        $data['slip_gaji']      = $this->gaji->where('YEAR(slip_gaji.created_at)', date('Y'))->where('MONTH(slip_gaji.created_at)', date('m'))
            ->where('slip_gaji.nip_pegawai', $nip)
            ->first();

        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('divisi')
            ->join('jabatan')
            ->join('lokasi')
            ->first();

        $this->gaji->table      = 'gaji';
        $data['gaji']           = $this->gaji->where('gaji.nip_pegawai', $nip)->first();

        $nama_bulan   = date_format(new DateTime($data['slip_gaji']->created_at), 'F');
        $tahun        = date_format(new DateTime($data['slip_gaji']->created_at), 'Y');
        $nama_pegawai = str_replace(" ", "-", strtolower($data['pegawai']->nama));


        $this->mypdf->generate('pages/gaji/slip/cetak', $data, 'slip-gaji-' . $nama_pegawai . '-' . $nama_bulan . '-' . $tahun, 'A4', 'landscape');
        //$this->load->view('pages/gaji/slip/cetak', $data);
    }

    public function print_slip_gaji($id, $nip)
    {
        $this->gaji->table      = 'slip_gaji';
        $data['slip_gaji']      = $this->gaji->where('slip_gaji.id', $id)
            ->first();

        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('divisi')
            ->join('jabatan')
            ->join('lokasi')
            ->first();

        $this->gaji->table      = 'gaji';
        $data['gaji']           = $this->gaji->where('gaji.nip_pegawai', $nip)->first();

        $nama_bulan   = date_format(new DateTime($data['slip_gaji']->created_at), 'F');
        $tahun        = date_format(new DateTime($data['slip_gaji']->created_at), 'Y');
        $nama_pegawai = str_replace(" ", "-", strtolower($data['pegawai']->nama));

        $this->mypdf->generate('pages/gaji/slip/cetak', $data, 'slip-gaji-' . $nama_pegawai . '-' . $nama_bulan . '-' . $tahun, 'A4', 'landscape');
    }

    public function insert_slip()
    {
        $this->gaji->table  = 'slip_gaji';
        $id_gaji            = $this->input->post('id_gaji', true);
        $nip_pegawai        = $this->input->post('nip_pegawai', true);
        $lembur             = $this->input->post('lembur', true);
        $bonus              = $this->input->post('bonus', true);
        $bpjs               = $this->input->post('bpjs', true);
        $bon                = $this->input->post('bon', true);
        $simp_koperasi      = $this->input->post('simp_koperasi', true);
        $dana_sosial        = $this->input->post('dana_sosial', true);
        $pinjaman           = $this->input->post('pinjaman', true);
        $kpi                = $this->input->post('kpi', true);
        $total_gaji         = $this->input->post('total_gaji', true);


        $data               = array(
            'id_gaji'           => $id_gaji,
            'nip_pegawai'       => $nip_pegawai,
            'lembur'            => (int) str_replace(".", "", $lembur),
            'bonus'             => (int) str_replace(".", "", $bonus),
            'bpjs'              => (int) str_replace(".", "", $bpjs),
            'bon'               => (int) str_replace(".", "", $bon),
            'simp_koperasi'     => (int) str_replace(".", "", $simp_koperasi),
            'dana_sosial'       => (int) str_replace(".", "", $dana_sosial),
            'pinjaman'          => (int) str_replace(".", "", $pinjaman),
            'kpi'               => (int) str_replace(".", "", $kpi),
            'total_gaji'        => $total_gaji,
            'created_at'        => date("Y-m-d"),
        );

        if ($this->gaji->add($data) == true) {
            echo json_encode(array(
                'statusCode'    => 200
            ));
        } else {
            echo json_encode(array(
                'statusCode'    => 201
            ));
        }
    }

    public function update_slip()
    {
        $this->gaji->table  = 'slip_gaji';
        $id                 = $this->input->post('id', true);
        $id_gaji            = $this->input->post('id_gaji', true);
        $nip_pegawai        = $this->input->post('nip_pegawai', true);
        $lembur             = $this->input->post('lembur', true);
        $bonus              = $this->input->post('bonus', true);
        $bpjs               = $this->input->post('bpjs', true);
        $bon                = $this->input->post('bon', true);
        $simp_koperasi      = $this->input->post('simp_koperasi', true);
        $dana_sosial        = $this->input->post('dana_sosial', true);
        $pinjaman           = $this->input->post('pinjaman', true);
        $kpi                = $this->input->post('kpi', true);
        $total_gaji         = $this->input->post('total_gaji', true);


        $data               = array(
            'id_gaji'           => $id_gaji,
            'nip_pegawai'       => $nip_pegawai,
            'lembur'            => (int) str_replace(".", "", $lembur),
            'bonus'             => (int) str_replace(".", "", $bonus),
            'bpjs'              => (int) str_replace(".", "", $bpjs),
            'bon'               => (int) str_replace(".", "", $bon),
            'simp_koperasi'     => (int) str_replace(".", "", $simp_koperasi),
            'dana_sosial'       => (int) str_replace(".", "", $dana_sosial),
            'pinjaman'          => (int) str_replace(".", "", $pinjaman),
            'kpi'               => (int) str_replace(".", "", $kpi),
            'total_gaji'        => $total_gaji,
            'created_at'        => date("Y-m-d"),
        );

        if ($this->gaji->where('slip_gaji.id', $id)->update($data)) {
            echo json_encode(array(
                'statusCode'    => 200
            ));
        } else {
            echo json_encode(array(
                'statusCode'    => 201
            ));
        }
    }

    public function viewDetailGaji()
    {
        $id_gaji = $this->input->get('id_gaji', true);

        $this->gaji->table      = 'pegawai';
        $data['content']    = $this->gaji->select([
            'pegawai.nip', 'pegawai.nama', 'pegawai.image',
            'pegawai.jenis_kelamin', 'pegawai.tempat_lahir',
            'pegawai.tgl_lahir', 'pegawai.email', 'pegawai.nohp', 'grade.title',
            'divisi.nama_divisi', 'jabatan.nama_jabatan',
            'gaji.gaji', 'gaji.insentif_kehadiran', 'gaji.tunjangan', 'gaji.tunjangan_kerajinan',
            'gaji.jumlah_gaji', 'gaji.created_at'
        ])
            ->joinGaji('gaji')
            ->join('divisi')
            ->join('jabatan')
            ->join('grade')
            ->where('gaji.id', $id_gaji)
            ->first();

        $data['title'] = 'Detail Gaji ' . $data['content']->nama;

        //print_r($data['content']);
        $this->output->set_output(show_my_modal('pages/gaji/modal/modal_detail_gaji', 'modal-detail-gaji', $data, 'lg'));
    }

    public function rekapitulasi_gaji_pegawai()
    {

        $this->gaji->table = 'pegawai';
        $data['rekap']     = $this->gaji->select([
            'pegawai.nama', 'jabatan.nama_jabatan', 'grade.title',
            'pegawai.pendidikan',
            'gaji.gaji', 'gaji.insentif_kehadiran',
            'gaji.tunjangan', 'gaji.tunjangan_kerajinan', 'gaji.jumlah_gaji'
        ])
            ->joinGaji('gaji', 'right')
            ->join('jabatan')
            ->join('grade')
            ->get();

        //print_r($data['rekap']);
        $spreadsheet = new Spreadsheet();

        //title
        $spreadsheet->getActiveSheet()->mergeCells('A2:J2');
        $spreadsheet->getActiveSheet()->mergeCells('A3:J3');
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'PT.SORAYA BERJAYA INDONESIA');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'REKAPITULASI GAJI PEGAWAI');

        //style title
        $styleArrayTitle1 = [
            'font'      => [
                'size'          => 18,
                'bold'          => true,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];

        $styleArrayTitle2 = [
            'font'      => [
                'size'          => 14,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];

        $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($styleArrayTitle1);
        $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($styleArrayTitle2);

        //header
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A5', 'No')
            ->setCellValue('B5', 'Nama')
            ->setCellValue('C5', 'Jabatan')
            ->setCellValue('D5', 'Grading')
            ->setCellValue('E5', 'Pendidikan')
            ->setCellValue('F5', 'Gaji Pokok')
            ->setCellValue('G5', 'Tunjangan Kehadiran')
            ->setCellValue('H5', 'Tunjangan Operasional')
            ->setCellValue('I5', 'Tunjangan Kerajinan')
            ->setCellValue('J5', 'Total Gaji');

        $styleHeader = [
            'alignment'     => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];

        //apply style header
        $spreadsheet->getActiveSheet()->getStyle('A5:J5')->applyFromArray($styleHeader);

        //set width column automatically
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);


        //set height row header
        $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(30);


        //data section
        //posisi kolom dan nomor
        $kolom = 6;
        $no = 1;

        //get data
        foreach ($data['rekap'] as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $no)
                ->setCellValue('B' . $kolom, $row->nama)
                ->setCellValue('C' . $kolom, $row->nama_jabatan)
                ->setCellValue('D' . $kolom, $row->title)
                ->setCellValue('E' . $kolom, $row->pendidikan)
                ->setCellValue('F' . $kolom, $row->gaji)
                ->setCellValue('G' . $kolom, $row->insentif_kehadiran)
                ->setCellValue('H' . $kolom, $row->tunjangan)
                ->setCellValue('I' . $kolom, $row->tunjangan_kerajinan)
                ->setCellValue('J' . $kolom, "=SUM(F$kolom:I$kolom)");

            $kolom++;
            $no++;
        }

        //style for all borders
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000'],
                ],
            ],
        ];
        $sheet = $spreadsheet->getActiveSheet();
        $batas = count($data['rekap']) + 5;
        $sheet->getStyle('A5:J' . $batas)->applyFromArray($styleArray);

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="rekap_gaji_pegawai_sbi.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}

/* End of file Gaji.php */
