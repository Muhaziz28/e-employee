<?php

function show_my_modal($content = '', $id = '', $data = '', $size = 'md')
{
    $CI = &get_instance();

    if ($content != '') {
        $view_content = $CI->load->view($content, $data, TRUE);

        return '<div class="modal fade" id="' . $id . '" role="dialog">
                  <div class="modal-dialog modal-' . $size . '" role="document">
                    <div class="modal-content">
                        ' . $view_content . '
                    </div>
                  </div>
                </div>';
    }
}


function getDropdownList($table, $columns)
{
    $CI    = &get_instance();
    $query = $CI->db->select($columns)->from($table)->get();

    if ($query->num_rows() >= 1) {
        $option1 = ['' => '- Select -'];
        $option2 = array_column($query->result_array(), $columns[1], $columns[0]);
        $options = $option1 + $option2;

        return $options;
    }


    return $options = ['' => '- Select -'];
}

function getNipMax($jenis_kelamin)
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT * FROM `pegawai` WHERE jenis_kelamin = '" . $jenis_kelamin . "' ORDER BY SUBSTRING(pegawai.nip, 5) DESC LIMIT 1");
    $result = $query->row();
    return $result;
}



function konversiBln($blnsekarang)
{
    switch ($blnsekarang) {
        case "Jan":
            $convBln = "Jan";
            break;
        case "Feb":
            $convBln = "Feb";
            break;
        case "Mar":
            $convBln = "Mar";
            break;
        case "Apr":
            $convBln = "Apr";
            break;
        case "May":
            $convBln = "Mei";
            break;
        case "Jun":
            $convBln = "Jun";
            break;
        case "Jul":
            $convBln = "Jul";
            break;
        case "Aug":
            $convBln = "Agu";
            break;
        case "Sep":
            $convBln = "Sep";
            break;
        case "Oct":
            $convBln = "Okt";
            break;
        case "Nov":
            $convBln = "Nov";
            break;
        case "Dec":
            $convBln = "Des";
            break;
    }

    return $convBln;
}

function koversiBlnLengkap($bln)
{
    switch ($bln) {
        case "Jan":
            $convBln = "Januari";
            break;
        case "Feb":
            $convBln = "Februari";
            break;
        case "Mar":
            $convBln = "Maret";
            break;
        case "Apr":
            $convBln = "April";
            break;
        case "May":
            $convBln = "Mei";
            break;
        case "Jun":
            $convBln = "Juni";
            break;
        case "Jul":
            $convBln = "Juli";
            break;
        case "Aug":
            $convBln = "Agustus";
            break;
        case "Sep":
            $convBln = "September";
            break;
        case "Oct":
            $convBln = "Oktober";
            break;
        case "Nov":
            $convBln = "November";
            break;
        case "Dec":
            $convBln = "Desember";
            break;
    }

    return $convBln;
}


function hashEncrypt($input)
{
    $hash   = password_hash($input, PASSWORD_DEFAULT);
    return $hash;
}

function hashEncryptVerify($input, $hash)
{
    if (password_verify($input, $hash)) {
        return true;
    } else {
        return false;
    }
}


function checkGaji($nip)
{
    $CI     = &get_instance();
    $query = $CI->db->query("SELECT gaji.nip_pegawai FROM gaji WHERE gaji.nip_pegawai = '$nip'");
    $result = $query->num_rows();
    return $result;
}

function checkSlipGaji($tanggal)
{
    // $CI     = &get_instance();
    // $query = $CI->db->query("SELECT gaji.nip_pegawai FROM gaji WHERE gaji.nip_pegawai = '$nip'");
    // $result = $query->num_rows();
    // return $result;

    $getTahun = date_format(new DateTime($tanggal), 'Y');
    $getBulan = date_format(new DateTime($tanggal), 'm');

    if ($getTahun != date('Y') && $getBulan != date('m')) {
        return true;
    } else {
        return false;
    }
}



function random_password()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array();
    $alpha_length = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alpha_length);
        $password[] = $alphabet[$n];
    }
    return implode($password);
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
}
