<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');

        if ($is_login != true) {
            redirect(base_url());
            return;
        }
    }

    public function index()
    {

        $data['title']          = 'Cuti - Daftar Cuti Pegawai';
        $data['nav_title']      = 'cuti';
        $data['detail_title']   = 'cuti';
        $data['page']           = 'pages/cuti/index';

        $this->view($data);
    }

    public function showFormCuti()
    {
        $data['title']     = 'Form Ajukan Cuti';

        $this->cuti->table = 'pegawai';
        $data['pegawai']   = $this->cuti->where('is_out', 1)->get();
        $this->output->set_output(show_my_modal('pages/cuti/modal/modal_add_cuti', 'modal-add-cuti', $data, 'lg'));
    }

    public function insert()
    {
        $nama_pegawai       = $this->input->post('nama_pegawai', true);
        $nip_pegawai        = $this->input->post('nip_pegawai', true);
        $jenis_cuti         = $this->input->post('jenis_cuti', true);
        $lama_cuti          = $this->input->post('lama_cuti', true);
        $tgl_cuti           = $this->input->post('tgl_cuti', true);
        $alasan_cuti        = $this->input->post('alasan_cuti', true);
        $alamat_cuti        = $this->input->post('alamat_cuti', true);
        $nip_pengganti      = $this->input->post('nip_pengganti', true);
        $jatah_cuti         = $this->session->userdata('jatah_cuti');

        if (!$this->cuti->validate()) {

            $array = array(
                'error'                 => true,
                'statusCode'            => 400,
                'jenis_cuti_error'      => form_error('jenis_cuti'),
                'lama_cuti_error'       => form_error('lama_cuti'),
                'tgl_cuti_error'        => form_error('tgl_cuti'),
                'alasan_cuti_error'     => form_error('alasan_cuti'),
                'alamat_cuti_error'     => form_error('alamat_cuti'),
                'nip_pengganti_error'   => form_error('nip_pengganti'),

            );

            echo json_encode($array);
        } else {
            $data = [
                'id'            => date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1),
                'nip_pegawai'   => $nip_pegawai,
                'lama_cuti'     => $lama_cuti,
                'tgl_cuti'      => $tgl_cuti,
                'jenis_cuti'    => $jenis_cuti,
                'alasan_cuti'   => $alasan_cuti,
                'alamat_cuti'   => $alamat_cuti,
                'nip_pengganti' => $nip_pengganti
            ];

            $data_pegawai = [
                'nama'              => $this->session->userdata('name'),
                'alamat'            => $this->session->userdata('alamat'),
                'nohp'              => $this->session->userdata('nohp'),
                'jabatan'           => $this->session->userdata('nama_jabatan'),
                'lama_cuti'         => $lama_cuti,
                'alasan_cuti'       => $alasan_cuti

            ];

            if ($this->cuti->add($data) == true) {

                // $this->cuti->table = 'pegawai';
                // $this->cuti->where('nip', $this->session->userdata('nip'))->update(['jatah_cuti' => $jatah_cuti - $lama_cuti]);

                //notification with pusher to admin
                require APPPATH . 'views/vendor/autoload.php';

                $options = array(
                    'cluster' => 'ap1',
                    'useTLS' => true
                );
                $pusher = new Pusher\Pusher(
                    '1533388f429c74588023',
                    '3cef4f78903478fe4b8c',
                    '1135943',
                    $options
                );

                $data['message'] = 'hello world';
                $data['nama']    = $nama_pegawai;
                $pusher->trigger('my-channel', 'my-event', $data);

                if ($this->sendMail($this->session->userdata('name'), 'hrd@sorayabedsheet.id', $data_pegawai)) {
                    echo json_encode(array(
                        "statusCode" => 200,
                    ));
                }
            } else {
                echo json_encode(array(
                    "statusCode" => 201,
                ));
            }
        }
    }

    public function checkCutiPerDay($nip)
    {
        $check = $this->cuti->where('nip_pegawai', $nip)
            ->where('YEAR(created_at)', date("Y"))
            ->where('MONTH(created_at)', date("m"))
            ->where('DAY(created_at)', date("d"))
            ->where('status_cuti', 'pending')
            ->count();

        if ($check > 0) {

            $array = array(
                'statusCode' => 200,
                'message'    => 'Pengajuan Cuti hanya dapat diajukan 1x sehari',
            );
        } else {
            $array = array(
                'statusCode' => 400,
                'message'    => '',
            );
        }
        echo json_encode($array);
    }

    public function max_cuti()
    {
        $lama_cuti          = $this->input->post('lama_cuti', true);
        $jenis_cuti         = $this->input->post('jenis_cuti', true);

        if ($jenis_cuti == "Cuti Tahunan") {
            if ($lama_cuti > 12) {
                $this->load->library('form_validation');
                $this->form_validation->set_message('max_cuti', '%s harus kurang dari 12');
                return false;
            }
        }
        return true;
    }

    public function sendMail($nama, $toEmail, $data_arr)
    {
        $config = array(
            'mailtype'  => 'html',
            'protocol'  => 'smtp',
            'smtp_host' => 'srv98.niagahoster.com',
            'smtp_port' =>  587,
            'smtp_user' => 'admin@sorayabedsheet.id',
            'smtp_pass' => '26sitebarancakbana',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );



        $this->load->library('email', $config);
        $this->email->from('admin@sorayabedsheet.id', $nama);
        $this->email->to($toEmail);
        $this->email->subject('Pengajuan Cuti');
        $this->email->message($this->load->view('email/cuti_notification', $data_arr, true));

        if ($this->email->send()) {
            //echo 'Email berhasil dikirim';
            echo json_encode(array(
                "statusCode" => 200,

            ));
        } else {
            echo 'Email tidak berhasil dikirim';
            echo '<br />';
            echo $this->email->print_debugger();
        }
    }

    public function loadTable()
    {
        $data['content']        = $this->cuti->orderBy('cuti.created_at', 'DESC')
            ->joinPegawai('pegawai')
            ->get();

        //print_r($data['content']);
        $this->load->view('pages/cuti/table_ajax', $data);
    }

    public function tes()
    {
        $this->load->view('email/cuti_notification_to_pegawai');
    }

    public function detail($id)
    {
        $data['title']      = 'Lihat Detail Cuti';
        $data['content']    = $this->cuti->joinPegawai('pegawai')
            ->where('cuti.id', $id)
            ->first();

        $this->cuti->table = 'pegawai';
        $data['pegawai']    = $this->cuti->get();

        //print_r($data['content']);

        $this->output->set_output(show_my_modal('pages/cuti/modal/modal_detail_cuti', 'modal-detail-cuti', $data, 'lg'));
    }

    public function update_status_cuti($id, $status, $nama, $toEmail, $jenisCuti = null, $lamaCuti = null, $jatahCuti = null, $nip = null)
    {
        if ($this->input->is_ajax_request()) {
            if ($status == "diterima") {
                if ($this->cuti->where('id', $id)->update(['status_cuti' => 'diterima'])) {

                    //kurangi jatah cuti pegawai
                    $conv_jenis_cuti = urldecode($jenisCuti);
                    if ($conv_jenis_cuti == "Cuti Tahunan") {
                        $this->cuti->table = 'pegawai';
                        $this->cuti->where('nip', $nip)->update(['jatah_cuti' => $jatahCuti - $lamaCuti]);

                        //set ulang session data jatah cuti
                        $array = array(
                            'jatah_cuti' => $jatahCuti - $lamaCuti
                        );

                        $this->session->set_userdata($array);
                    }



                    $this->sendMailToPegawai(urldecode($nama), 'hrd@sorayabedsheet.id', $toEmail, $status);
                    echo json_encode(
                        array(
                            'statusCode' => 200
                        )
                    );
                }
            } else {
                if ($this->cuti->where('id', $id)->update(['status_cuti' => 'ditolak'])) {
                    $this->sendMailToPegawai(urldecode($nama), 'hrd@sorayabedsheet.id', $toEmail, $status);
                    echo json_encode(
                        array(
                            'statusCode' => 200
                        )
                    );
                }
            }
        } else {
            echo "Don't have an access!";
        }
    }

    public function sendMailToPegawai($nama, $fromEmail, $toEmail, $status)
    {
        $config = array(
            'mailtype'  => 'html',
            'protocol'  => 'smtp',
            'smtp_host' => 'srv98.niagahoster.com',
            'smtp_port' =>  587,
            'smtp_user' => 'admin@sorayabedsheet.id',
            'smtp_pass' => '26sitebarancakbana',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );

        $data = [
            'nama' => $nama,
            'status' => $status
        ];

        $this->load->library('email', $config);
        $this->email->from($fromEmail, 'Human Resources');
        $this->email->to($toEmail);
        $this->email->subject('Tindak Lanjut Pengajuan Cuti');
        $this->email->message($this->load->view('email/cuti_notification_to_pegawai', $data, true));

        if ($this->email->send()) {
            //echo 'Email berhasil dikirim';
            echo json_encode(array(
                "statusCode" => 200,

            ));
        } else {
            echo 'Email tidak berhasil dikirim';
            echo '<br />';
            echo $this->email->print_debugger();
        }
    }

    public function potong()
    {

        $data['title']          = 'Potong Cuti - Cuti Pegawai';
        $data['nav_title']      = 'cuti';
        $data['detail_title']   = 'potong_cuti';

        $this->cuti->table      = 'pegawai';
        $data['getPegawai']     = $this->cuti->where('is_out', 1)->get();
        $data['page']           = 'pages/cuti/potong/index';

        $this->view($data);
    }

    public function showFormPotongCuti()
    {

        $this->cuti->table      = 'pegawai';
        $data['getPegawai']     = $this->cuti->where('is_out', 1)->get();
        echo $this->load->view('pages/cuti/potong/form_potong_cuti', $data, true);
    }

    public function potong_jatah_cuti_pegawai()
    {
        $nip_pegawai = $this->input->post('nip_pegawai', true);
        //$jatah_cuti = $this->input->post('jatah_cuti', true);

        $tgl_start = $this->input->post('tgl_start', true);
        $tgl_end   = $this->input->post('tgl_end', true);
        $alasan    = $this->input->post('alasan', true);
        $diff      = date_diff(new DateTime($tgl_start), new DateTime($tgl_end));
        $jatah_cuti = ($diff->d + 1);
        $jatah_cuti_from_db = $this->input->post('jatah_cuti_from_db', true);

        if (!$this->cuti->validate2()) {

            $array = array(
                'error' => true,
                'statusCode' => 400,
                'nip_pegawai_error' => form_error('nip_pegawai'),


            );

            echo json_encode($array);
        } else {

            $update_jatah_cuti = $jatah_cuti_from_db - $jatah_cuti < 0 ? 0 : $jatah_cuti_from_db - $jatah_cuti;
            $data = [
                'jatah_cuti' => $update_jatah_cuti
            ];

            $this->cuti->table = 'pegawai';

            if ($this->cuti->where('pegawai.nip', $nip_pegawai)->update($data)) {

                if ($update_jatah_cuti != 0) {
                    $this->cuti->table = 'potong_cuti';
                    $data_insert = array(
                        'id'        => date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1),
                        'nip'       => $nip_pegawai,
                        'tgl_start' => $tgl_start,
                        'tgl_end'   => $tgl_end,
                        'jumlah'    => $jatah_cuti,
                        'alasan'    => $alasan
                    );

                    $this->cuti->add($data_insert);
                }



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

    public function history_cuti($nip)
    {
        $data['title']            = 'Riwayat Cuti';
        $data['getCuti']        = $this->cuti->where('nip_pegawai', $nip)->get();
        $this->output->set_output(show_my_modal('pages/cuti/modal/modal_history_cuti', 'modal-history-cuti', $data, 'lg'));
    }

    public function loadTableModal($nip, $status = null)
    {
        if ($status) {
            $data['getCuti']        = $this->cuti->orderBy('created_at', 'DESC')->where('nip_pegawai', $nip)->where('status_cuti', $status)->get();
        } else {
            $data['getCuti']        = $this->cuti->orderBy('created_at', 'DESC')->where('nip_pegawai', $nip)->get();
        }
        $this->load->view('pages/cuti/modal/table_ajax', $data);
    }

    public function history_potong_cuti()
    {
        $data['title']          = 'Riwayat Potong Cuti - Cuti Pegawai';
        $data['nav_title']      = 'history_potong_cuti';
        $data['detail_title']   = 'history_potong_cuti';

        $this->cuti->table      = 'potong_cuti';
        $data['getPegawai']     = $this->cuti->where('nip', $this->session->userdata('nip'))->get();
        $data['page']           = 'pages/cuti/history_potong_cuti';

        $this->view($data);
    }

    public function loadTablePotongCutiPegawai()
    {

        $this->cuti->table      = 'pegawai';
        $data['pegawai']        = $this->cuti->where('nip', $this->session->userdata('nip'))->join('divisi')->join('jabatan')->first();
        $this->cuti->table      = 'potong_cuti';
        $data['content']        =  $this->cuti->where('nip', $this->session->userdata('nip'))->get();
        $this->load->view('pages/cuti/history_potong_cuti_table_ajax', $data);
    }

    public function riwayat_potong_cuti()
    {
        $data['title']          = 'Cuti - Riwayat Pemotongan Cuti Pegawai';
        $data['nav_title']      = 'cuti';
        $data['detail_title']   = 'riwayat_potong_cuti';

        $this->cuti->table      = 'pegawai';
        $data['getPegawai']     = $this->cuti->where('is_out', 1)->get();
        $data['page']           = 'pages/cuti/riwayat_pemotongan_cuti/index';

        $this->view($data);
    }

    public function showFormRiwayatPemotonganCuti()
    {
        $this->cuti->table      = 'pegawai';
        $data['getPegawai']     = $this->cuti->where('is_out', 1)->orderBy('created_at', 'DESC')->get();
        echo $this->load->view('pages/cuti/riwayat_pemotongan_cuti/riwayat_pemotongan_cuti', $data, true);
    }

    public function resultRiwayatPerubahanGaji($nip)
    {
        $this->gaji->table      = 'pegawai';
        $data['pegawai']        = $this->gaji->where('pegawai.nip', $nip)->join('jabatan')->join('divisi')
            ->joinGaji('gaji')->first();

        $this->cuti->table      = 'potong_cuti';
        $data['riwayat']        = $this->cuti->where('nip', $nip)->get();
        $data['countRiwayat']   = $this->cuti->where('nip', $nip)->count();

        $this->cuti->table      = 'cuti';
        $data['riwayat_cuti']   = $this->cuti->where('nip_pegawai', $nip)->get();

        $this->load->view('pages/cuti/riwayat_pemotongan_cuti/result', $data);
    }
}

/* End of file Cuti.php */
