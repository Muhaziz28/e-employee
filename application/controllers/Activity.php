<?php


defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Activity extends MY_Controller
{


    private $role;
    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $this->role = $this->session->userdata('role');
        if ($is_login != true) {
            redirect(base_url());
            return;
        }
    }


    public function index()
    {
        $data['title']          = 'Data Aktivitas Harian - Aktivitas Harian Pegawai';
        $data['nav_title']      = 'aktivitas';
        $data['detail_title']   = 'aktivitas';


        $data['content']        = $this->activity->select(
            [
                'id', 'nip_pegawai',
                'isi_aktivitas AS aktivitas',
                'mulai', 'selesai',
                'realisasi', 'target',
                'DATE(created_at) AS tanggal'
            ]
        )
            ->where('nip_pegawai', $this->session->userdata('nip'))
            ->orderBy('created_at', 'DESC')
            ->get();

        $this->activity->table  = 'pegawai';
        $data['pegawai']        = $this->activity->where('nip', $this->session->userdata('nip'))->join('divisi')->join('jabatan')->first();

        if ($this->role == 'hrd') {
            $data['getPegawai']     = $this->activity->where('is_out', 1)
                ->orderBy('created_at', 'DESC')->get();
        } else if ($this->role == 'leader') {
            $data['getPegawai']     = $this->activity->where('is_out', 1)
                ->where('pegawai.id_divisi', $data['pegawai']->id_divisi)
                ->orderBy('created_at', 'DESC')->get();
        } else if ($this->role == 'leader_finance') {
            $data['getPegawai']     = $this->activity->where('is_out', 1)
                ->where('pegawai.id_divisi', $data['pegawai']->id_divisi)
                ->orderBy('created_at', 'DESC')->get();
        } else if ($this->role == 'leader_toko') {
            $data['getPegawai']     = $this->activity->where('is_out', 1)
                ->where('pegawai.id_lokasi', $data['pegawai']->id_lokasi)
                ->orderBy('created_at', 'DESC')->get();
        }
        $data['page']           = 'pages/activity/index';


        $this->view($data);
    }

    public function load_aktivitas_pegawai()
    {
        $data['content']        = $this->activity->select(
            [
                'id', 'nip_pegawai',
                'isi_aktivitas AS aktivitas',
                'mulai', 'selesai',
                'realisasi', 'target',
                'DATE(created_at) AS tanggal'
            ]
        )
            ->where('nip_pegawai', $this->session->userdata('nip'))
            ->orderBy('created_at', 'DESC')
            ->get();

        $this->load->view('pages/activity/table_ajax', $data);
    }

    public function load_result_aktivitas_pegawai()
    {
        $nip_pegawai = $this->input->get('nip_pegawai', true);

        $data['content']        = $this->activity->select(
            [
                'id', 'nip_pegawai',
                'isi_aktivitas AS aktivitas',
                'mulai', 'selesai',
                'realisasi', 'target',
                'DATE(created_at) AS tanggal'
            ]
        )
            ->where('nip_pegawai', $nip_pegawai)
            ->orderBy('created_at', 'DESC')
            ->get();

        $this->activity->table = 'pegawai';
        $data['pegawai']        = $this->activity->where('nip', $nip_pegawai)->join('divisi')->join('jabatan')->first();


        $this->load->view('pages/activity/result', $data);
    }

    public function export_to_excel()
    {
        $nip_pegawai = $this->input->get('nip_pegawai', true);
        $data['content']        = $this->activity->select(
            [
                'id', 'nip_pegawai',
                'isi_aktivitas AS aktivitas',
                'mulai', 'selesai',
                'realisasi', 'target',
                'DATE(created_at) AS tanggal'
            ]
        )
            ->where('nip_pegawai', $nip_pegawai)
            ->orderBy('created_at', 'DESC')
            ->get();

        $this->activity->table = 'pegawai';
        $data['pegawai']        = $this->activity->where('nip', $nip_pegawai)->join('divisi')->join('jabatan')->first();

        $spreadsheet = new Spreadsheet();

        //title
        $spreadsheet->getActiveSheet()->mergeCells('A2:F2');
        $spreadsheet->getActiveSheet()->mergeCells('A3:F3');
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'PT.SORAYA BERJAYA INDONESIA');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'AKTIVITAS HARIAN PEGAWAI');

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


        //profile pegawai
        $spreadsheet->getActiveSheet()->setCellValue('A5', 'Nama');
        $spreadsheet->getActiveSheet()->setCellValue('A6', 'NIP');
        $spreadsheet->getActiveSheet()->setCellValue('B5', $data['pegawai']->nama);
        $spreadsheet->getActiveSheet()->setCellValue('B6', $data['pegawai']->nip);
        $spreadsheet->getActiveSheet()->setCellValue('E5', 'Divisi');
        $spreadsheet->getActiveSheet()->setCellValue('E6', 'Jabatan');
        $spreadsheet->getActiveSheet()->setCellValue('F5', $data['pegawai']->nama_divisi);
        $spreadsheet->getActiveSheet()->setCellValue('F6', $data['pegawai']->nama_jabatan);

        //header
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A8', 'Tanggal')
            ->setCellValue('B8', 'Aktivitas')
            ->setCellValue('C8', 'Mulai')
            ->setCellValue('D8', 'Selesai')
            ->setCellValue('E8', 'Realisasi')
            ->setCellValue('F8', 'Target');


        $styleHeader = [
            'alignment'     => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];

        //apply style header
        $spreadsheet->getActiveSheet()->getStyle('A8:F8')->applyFromArray($styleHeader);

        //set width column automatically
        $chars = range('a', 'f');

        foreach ($chars as $char) {
            $spreadsheet->getActiveSheet()->getColumnDimension($char)->setAutoSize(true);
        }

        //set height row header
        $spreadsheet->getActiveSheet()->getRowDimension('8')->setRowHeight(30);


        //data section
        $kolom = 9;
        foreach ($data['content'] as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, date_format(new DateTime($row->tanggal), 'd/m/Y'))
                ->setCellValue('B' . $kolom, $row->aktivitas)
                ->setCellValue('C' . $kolom, date_format(new DateTime($row->mulai), 'H:i'))
                ->setCellValue('D' . $kolom, date_format(new DateTime($row->selesai), 'H:i'))
                ->setCellValue('E' . $kolom, $row->realisasi)
                ->setCellValue('F' . $kolom, $row->target);

            $kolom++;
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
        $batas = count($data['content']) + 8;
        $sheet->getStyle('A8:F' . $batas)->applyFromArray($styleArray);


        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="aktivitas_pegawai.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_to_excel_arr()
    {
        $nip_pegawai = ['01200014', '01180005'];

        foreach ($nip_pegawai as $pegawai) {
            $contents = $this->activity->select(
                [
                    'id', 'nip_pegawai',
                    'isi_aktivitas AS aktivitas',
                    'mulai', 'selesai',
                    'realisasi', 'target',
                    'DATE(created_at) AS tanggal'
                ]
            )
                ->where('nip_pegawai', $pegawai)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
    }

    public function rekap($month = '', $year = '')
    {

        $data['title']          = 'Data Rekap Pengisian Aktivitas Harian - Aktivitas Harian Pegawai';
        $data['nav_title']      = 'aktivitas';
        $data['detail_title']   = 'rekap_aktivitas';

        $this->activity->table  = 'pegawai';
        $data['pegawai_first']        = $this->activity->where('nip', $this->session->userdata('nip'))->join('divisi')->join('jabatan')->first();
        if ($this->role == 'hrd') {
            $data['pegawai']        = $this->activity->where('is_out', 1)->orderBy('created_at', 'ASC')->get();
        } else if ($this->role == 'leader') {
            $data['pegawai']        = $this->activity->where('is_out', 1)
                ->where('pegawai.id_divisi', $data['pegawai_first']->id_divisi)
                ->orderBy('created_at', 'ASC')->get();
        } else if ($this->role == 'leader_finance') {
            $data['pegawai']        = $this->activity->where('is_out', 1)
                ->where('pegawai.id_divisi', $data['pegawai_first']->id_divisi)
                ->orderBy('created_at', 'ASC')->get();
        } else if ($this->role == 'leader_toko') {
            $data['pegawai']        = $this->activity->where('is_out', 1)
                ->where('pegawai.id_lokasi', $data['pegawai_first']->id_lokasi)
                ->orderBy('created_at', 'ASC')->get();
        }

        //get cal days in month

        if ($month != '' && $year != '') {
            $limit_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        } else {
            $limit_day = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        }

        //echo $limit_day;

        $data['limit_day'] = $limit_day;

        $this->activity->table = 'aktivitas';
        foreach ($data['pegawai'] as $row) {
            $get_nip_pegawai = $row->nip;

            //check di table aktivitas apakah sudah diisi pada tgl tertentu
            for ($date = 1; $date <= $limit_day; $date++) {
                if ($month != '' && $year != '') {
                    $get_date = $year . '-' . $month . '-' . $date;
                } else {
                    $get_date = date('Y') . '-' . date('m') . '-' . $date;
                }
                $check_activity = $this->activity->where('nip_pegawai', $get_nip_pegawai)
                    ->where('DATE(created_at)', $get_date)->count();

                //jika ada
                if ($check_activity > 0) {
                    $data['emp'][$get_nip_pegawai][$date] = 1;
                } else {
                    $data['emp'][$get_nip_pegawai][$date] = 0;
                }
            }
        }


        $data['page']           = 'pages/activity/rekap';

        if (!$this->input->is_ajax_request()) {
            $this->view($data);
        } else {
            $this->load->view('pages/activity/rekap_result', $data);
        }
    }

    public function tes()
    {
        $chars = range('a', 'z');

        foreach ($chars as $char) {
            echo $char;
        }
    }

    public function add()
    {

        //get data form
        $activity = $this->input->post("activity", true);
        $mulai = $this->input->post("mulai", true);
        $akhir = $this->input->post("akhir", true);
        $realisasi = $this->input->post("realisasi", true);
        $target = $this->input->post("target", true);
        $nip_pegawai = $this->input->post("nip_pegawai_activity", true);

        //create array for checking validate
        $activity_err_arr = [];
        $mulai_err_arr = [];
        $akhir_err_arr = [];
        $realisasi_err_arr = [];

        //check validate with array form
        if (!$this->activity->validate()) {
            foreach ($activity as $i => $val) {
                if (!$this->activity->validate_array($i)) {
                    array_push($activity_err_arr, ["activity_$i" => form_error("activity[" . $i . "]")]);
                    array_push($mulai_err_arr, ["mulai_$i" => form_error("mulai[" . $i . "]")]);
                    array_push($akhir_err_arr, ["akhir_$i" => form_error("akhir[" . $i . "]")]);
                    array_push($realisasi_err_arr, ["realisasi_$i" => form_error("realisasi[" . $i . "]")]);
                } else {
                    array_push($activity_err_arr, [
                        "activity_$i"       => ""
                    ]);
                    array_push($mulai_err_arr, [
                        "mulai_$i"       => ""
                    ]);
                    array_push($akhir_err_arr, [
                        "akhir_$i"       => ""
                    ]);
                    array_push($realisasi_err_arr, [
                        "realisasi_$i"       => ""
                    ]);
                }
            }

            echo json_encode([
                'statusCode'                 => 400,
                'error'                      => true,
                'activity_err_arr'           => json_encode($activity_err_arr),
                'mulai_err_arr'              => json_encode($mulai_err_arr),
                'akhir_err_arr'              => json_encode($akhir_err_arr),
                'realisasi_err_arr'          => json_encode($realisasi_err_arr),
            ]);
        } else {
            $data = [];

            foreach ($activity as $i     => $val) {
                array_push($data, [
                    'id'            => 'atv-' . date('YmdHis') . rand(pow(10, 3 - 1), pow(10, 3) - 1),
                    'nip_pegawai'   => $nip_pegawai,
                    'isi_aktivitas' => $val,
                    'mulai'         => $mulai[$i],
                    'selesai'       => $akhir[$i],
                    'realisasi'     => $realisasi[$i],
                    'target'        => $target[$i] == "" ? null : $target[$i],
                ]);
            }

            if ($this->activity->add_batch($data) == true) {
                echo json_encode([
                    'statusCode'                   => 200,
                    'status'                       => 'Success!',
                    'message'                      => 'Data Aktivitas telah ditambahkan!'
                ]);
            } else {
                echo json_encode([
                    'statusCode'                   => 201,
                    'status'                       => 'Error!',
                    'message'                      => 'Oops! Terjadi kesalahan!'
                ]);
            }
        }
    }

    public function edit()
    {
        $id = $this->input->get('id', true);
        $data['aktivitas']      = $this->activity->select([
            'id', 'nip_pegawai',
            'isi_aktivitas AS aktivitas',
            'mulai', 'selesai',
            'realisasi', 'target',
            'DATE(created_at) AS tanggal'
        ])
            ->where('id', $id)
            ->first();

        $this->output->set_output(show_my_modal('pages/activity/modal/modal_edit_form', 'modal-edit-activity', $data, 'xl'));
    }

    public function update()
    {
        $id_activity = $this->input->post('id_activity', true);
        $activity = $this->input->post('activity', true);
        $mulai = $this->input->post('mulai', true);
        $akhir = $this->input->post('akhir', true);
        $realisasi = $this->input->post('realisasi', true);
        $target = $this->input->post('target', true);

        if (!$this->activity->validate()) {
            $arr = [
                'statusCode'            => 400,
                'error'                 => true,
                'activity_edit_error'   => form_error("activity"),
                'mulai_edit_error'      => form_error("mulai"),
                'akhir_edit_error'      => form_error("akhir"),
                'realisasi_edit_error'  => form_error("realisasi"),
            ];

            echo json_encode($arr);
        } else {
            $data_udpate = [
                'id'            => $id_activity,
                'nip_pegawai'   => $this->session->userdata('nip'),
                'isi_aktivitas' => $activity,
                'mulai'         => $mulai,
                'selesai'       => $akhir,
                'realisasi'     => $realisasi,
                'target'        => $target,

            ];

            if ($this->activity->where('id', $id_activity)->update($data_udpate)) {
                echo json_encode([
                    'statusCode'                   => 200,
                    'status'                       => 'Success!',
                    'message'                      => 'Data Aktivitas berhasil diubah!',
                    'data_update'                  => json_encode($data_udpate),
                ]);
            } else {
                echo json_encode([
                    'statusCode'                   => 201,
                    'status'                       => 'Error!',
                    'message'                      => 'Oops! Terjadi kesalahan!'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        if ($this->input->is_ajax_request()) {
            if ($this->activity->where('id', $id)->delete()) {
                echo json_encode([
                    'statusCode'                   => 200,
                    'status'                       => 'Success!',
                    'message'                      => 'Data Aktivitas berhasil dihapus!',
                ]);
            } else {
                echo json_encode([
                    'statusCode'                   => 201,
                    'status'                       => 'Error!',
                    'message'                      => 'Oops! Terjadi kesalahan!'
                ]);
            }
        } else {
            http_response_code(403);
        }
    }

    public function validate_time($str)
    {
        if ($str != "") {
            if (strrchr($str, ":")) {
                list($hh, $mm) = explode(':', $str);
                if (!is_numeric($hh) || !is_numeric($mm)) {
                    $this->form_validation->set_message('validate_time', 'Bagian {field} harus berupa format waktu contoh: 08:00"');
                    return FALSE;
                } elseif ((int) $hh > 23 || (int) $mm > 59) {
                    $this->form_validation->set_message('validate_time', 'Bagian {field} format jam tidak melebihi 23 dan format menit tidak melebihi 59"');
                    return FALSE;
                } elseif (mktime((int) $hh, (int) $mm) === FALSE) {
                    return FALSE;
                }
                return TRUE;
            } else {
                $this->form_validation->set_message('validate_time', 'Bagian {field} harus berupa format waktu contoh: 08:00"');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('validate_time', 'Bagian {field} wajib diisi');
            return FALSE;
        }
    }
}


/* End of file Activity.php */
