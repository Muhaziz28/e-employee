<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends MY_Controller
{

    public function index($count = null)
    {
        $data['getNotifCuti'] = $this->notif->select([
            'pegawai.image', 'pegawai.nama', 'cuti.created_at AS tgl', 'cuti.id', 'cuti.status_notif'
        ])
            ->joinPegawai('pegawai')->orderBy('cuti.created_at', 'DESC')->limit(4)->get();

        //print_r($data['getNotifCuti']);


        if ($count != null || $count != '') {
            $array = array(
                'jumlahNotif' => $count
            );

            $this->session->set_userdata($array);
        }

        $this->load->view('pages/cuti/list_notif', $data);
    }

    public function unset()
    {
        $getNotif = $this->notif->select(['cuti.id'])->where('status_notif', 0)->get();

        foreach ($getNotif as $row) {
            $this->notif->where('id', $row->id)->update(['status_notif' => 1]);
        }

        if ($this->session->unset_userdata('jumlahNotif')) {



            echo json_encode(array(
                'statusCode'   => 200
            ));
        }
    }
}

/* End of file Notif.php */
