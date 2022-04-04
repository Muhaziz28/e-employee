<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{

    public function index()
    {


        $data['title']          = 'Laporan Pegawai In Out';
        $data['nav_title']      = 'report';
        $data['detail_title']   = 'Form Laporan Pegawai In Out';
        $data['page']           = 'pages/report/pegawai_in_out';

        $this->view($data);
    }

    public function showFormLaporanPegawaiInOut()
    {
        echo $this->load->view('pages/report/form_pegawai_in_out', '', true);
    }

    public function requestPegawaiInOut()
    {
        $formDate = $this->input->post('tgl_start', true);
        $toDate   = $this->input->post('tgl_end', true);

        if (!$this->report->validate()) {
            $array = array(
                'error' => true,
                'statusCode' => 400,
                'tgl_start_error' => form_error('tgl_start'),
                'tgl_end_error'   => form_error('tgl_end')
            );

            echo json_encode($array);
        } else {
            $data['pegawai_in']       = $this->report->where('pegawai.tgl_masuk >=', $formDate)
                ->where('pegawai.tgl_masuk <=', $toDate)
                ->where('pegawai.is_out', 1)
                ->join('divisi')
                ->join('jabatan')
                ->join('lokasi')
                ->get();

            $this->report->table      = 'pegawai_out';
            $data['pegawai_out']      = $this->report->where('pegawai_out.tgl_keluar >=', $formDate)
                ->where('pegawai_out.tgl_keluar <=', $toDate)
                ->join('divisi')
                ->join('jabatan')
                ->join('lokasi')
                ->get();

            echo json_encode(array(
                'statusCode' => 200,
                'result'     => $this->load->view('pages/report/list_report_pegawai_in_out', $data, true)
            ));
        }
    }

    public function exportToExcelPegawaiInOut()
    {
        $formDate = $this->input->post('tgl_start_excel', true);
        $toDate   = $this->input->post('tgl_end_excel', true);

        $pegawai_in       = $this->report->where('pegawai.tgl_masuk >=', $formDate)
            ->where('pegawai.tgl_masuk <=', $toDate)
            ->where('pegawai.is_out', 1)
            ->join('divisi')
            ->join('jabatan')
            ->join('lokasi')
            ->get();

        $this->report->table      = 'pegawai_out';
        $pegawai_out      = $this->report->where('pegawai_out.tgl_keluar >=', $formDate)
            ->where('pegawai_out.tgl_keluar <=', $toDate)
            ->join('divisi')
            ->join('jabatan')
            ->join('lokasi')
            ->get();

        if ($pegawai_in && $pegawai_out) {
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
                'widths' => [7, 30, 25, 38, 17, 25, 19, 20, 28, 29, 55, 30, 20, 27, 27, 20, 20, 20, 20, 24],
                'heights' => [21],
                'font' => 'Arial', 'font-size' => 12,
                'font-style' => 'bold',
                'fill' => '#eee',
                'halign' => 'center',
                'border' => 'left,right,top,bottom',
                'border-style'  => 'thin'
            );

            $styles_out = array(
                'widths' => [7, 30, 25, 38, 17, 25, 19, 20, 28, 29, 55, 30, 20, 27, 27, 20, 20, 20, 20, 55, 24],
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
                [
                    'font-size' => 11,
                    'border' => 'left,right,top,bottom',
                    'border-style'  => 'thin'
                ],


            );

            $styles2_out = array(
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

            $header2 = array(
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
                'Tgl Keluar'                => 'dd/mm/yyyy',
                'Alasan Keluar'             => 'string',
                'Durasi Kerja'              => 'string',


            );

            $writer = new XLSXWriter();
            $writer->setAuthor('admin');

            $writer->writeSheetHeader('Pegawai_In', $header, $styles);
            $writer->writeSheetHeader('Pegawai_Out', $header2, $styles_out);


            $no = 1;

            foreach ($pegawai_in as $row) {

                $tgl_masuk = new DateTime($row->tgl_masuk);
                $tgl_sekarang = new DateTime(date('Y-m-d'));

                $diff = date_diff($tgl_masuk, $tgl_sekarang);

                if ($diff->m == 0 && $diff->y == 0) {
                    $durasi = 'Kurang dari sebulan';
                } else if ($diff->y > 0) {
                    $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                } else {
                    $durasi = $diff->m . ' bulan ' . $diff->d . ' hari';
                }

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

                    'Pegawai_In',
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
                        $durasi



                    ],
                    $styles2
                );


                $no++;
            }

            foreach ($pegawai_out as $row) {

                $tgl_masuk = new DateTime($row->tgl_masuk);
                $tgl_sekarang = new DateTime($row->tgl_keluar);

                $diff = date_diff($tgl_masuk, $tgl_sekarang);

                if ($diff->m == 0 && $diff->y == 0) {
                    $durasi = 'Kurang dari sebulan';
                } else if ($diff->y > 0) {
                    $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                } else {
                    $durasi = $diff->m . ' bulan ' . $diff->d . ' hari';
                }

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

                    'Pegawai_Out',
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
                        $row->tgl_keluar,
                        $row->status_out == "Lainnya" ? $row->keterangan : $row->status_out,
                        $durasi



                    ],
                    $styles2_out
                );


                $no++;
            }


            $writer->writeToStdOut();
        } else {
        }
    }
}

/* End of file Report.php */
