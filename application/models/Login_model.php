<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends MY_Model
{

    protected $table    = 'pegawai';

    public function getDefaultValues()
    {
        return [
            'email'     =>  '',
            'password'     =>  '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ],
        ];

        return $validationRules;
    }

    public function run($input)
    {
        $query  = $this->join('divisi')
            ->join('jabatan')
            ->join('level')
            ->where('email', strtolower($input->email))
            ->where('is_out', 1)
            ->first();

        if (!$query) {
            $this->session->set_flashdata('warning', 'Akun anda tidak ditemukan, harap hubungi HRD.');
        }

        if (!empty($query) && hashEncryptVerify($input->password, $query->password)) {
            if ($query->nama_jabatan == 'HRD' || $query->nama_jabatan == 'Web Developer') {
                $sess_data = [
                    'nip'               => $query->nip,
                    'name'              => $query->nama,
                    'email'             => $query->email,
                    'tempat_lahir'      => $query->tempat_lahir,
                    'tgl_lahir'         => $query->tgl_lahir,
                    'jenis_kelamin'     => $query->jenis_kelamin,
                    'agama'             => $query->agama,
                    'status'            => $query->status,
                    'status_pegawai'    => $query->status_pegawai,
                    'alamat'            => $query->alamat,
                    'nohp'              => $query->nohp,
                    'pendidikan'        => $query->pendidikan,
                    'nama_divisi'       => $query->nama_divisi,
                    'nama_jabatan'      => $query->nama_jabatan,
                    'nama_level'        => $query->nama_level,
                    'tgl_masuk'         => $query->tgl_masuk,
                    'tgl_mulai_kontrak' => $query->tgl_mulai_kontrak,
                    'tgl_akhir_kontrak' => $query->tgl_akhir_kontrak,
                    'role'              => 'hrd',
                    'image'             => $query->image,
                    'jatah_cuti'        => $query->jatah_cuti,
                    'is_login'          => true,
                ];
            } else if ($query->nama_jabatan == 'Leader') {
                $sess_data = [
                    'nip'               => $query->nip,
                    'name'              => $query->nama,
                    'email'             => $query->email,
                    'tempat_lahir'      => $query->tempat_lahir,
                    'tgl_lahir'         => $query->tgl_lahir,
                    'jenis_kelamin'     => $query->jenis_kelamin,
                    'agama'             => $query->agama,
                    'status'            => $query->status,
                    'status_pegawai'    => $query->status_pegawai,
                    'alamat'            => $query->alamat,
                    'nohp'              => $query->nohp,
                    'pendidikan'        => $query->pendidikan,
                    'nama_divisi'       => $query->nama_divisi,
                    'nama_jabatan'      => $query->nama_jabatan,
                    'nama_level'        => $query->nama_level,
                    'tgl_masuk'         => $query->tgl_masuk,
                    'tgl_mulai_kontrak' => $query->tgl_mulai_kontrak,
                    'tgl_akhir_kontrak' => $query->tgl_akhir_kontrak,
                    'role'              => 'leader',
                    'image'             => $query->image,
                    'jatah_cuti'        => $query->jatah_cuti,
                    'is_login'          => true,
                ];
            } else if ($query->nama_jabatan == 'Leader Toko') {
                $sess_data = [
                    'nip'               => $query->nip,
                    'name'              => $query->nama,
                    'email'             => $query->email,
                    'tempat_lahir'      => $query->tempat_lahir,
                    'tgl_lahir'         => $query->tgl_lahir,
                    'jenis_kelamin'     => $query->jenis_kelamin,
                    'agama'             => $query->agama,
                    'status'            => $query->status,
                    'status_pegawai'    => $query->status_pegawai,
                    'alamat'            => $query->alamat,
                    'nohp'              => $query->nohp,
                    'pendidikan'        => $query->pendidikan,
                    'nama_divisi'       => $query->nama_divisi,
                    'nama_jabatan'      => $query->nama_jabatan,
                    'nama_level'        => $query->nama_level,
                    'tgl_masuk'         => $query->tgl_masuk,
                    'tgl_mulai_kontrak' => $query->tgl_mulai_kontrak,
                    'tgl_akhir_kontrak' => $query->tgl_akhir_kontrak,
                    'role'              => 'leader_toko',
                    'image'             => $query->image,
                    'jatah_cuti'        => $query->jatah_cuti,
                    'is_login'          => true,
                ];
            } else if ($query->nama_jabatan == 'Leader' && $query->nama_divisi == 'Finance') {
                $sess_data = [
                    'nip'               => $query->nip,
                    'name'              => $query->nama,
                    'email'             => $query->email,
                    'tempat_lahir'      => $query->tempat_lahir,
                    'tgl_lahir'         => $query->tgl_lahir,
                    'jenis_kelamin'     => $query->jenis_kelamin,
                    'agama'             => $query->agama,
                    'status'            => $query->status,
                    'status_pegawai'    => $query->status_pegawai,
                    'alamat'            => $query->alamat,
                    'nohp'              => $query->nohp,
                    'pendidikan'        => $query->pendidikan,
                    'nama_divisi'       => $query->nama_divisi,
                    'nama_jabatan'      => $query->nama_jabatan,
                    'nama_level'        => $query->nama_level,
                    'tgl_masuk'         => $query->tgl_masuk,
                    'tgl_mulai_kontrak' => $query->tgl_mulai_kontrak,
                    'tgl_akhir_kontrak' => $query->tgl_akhir_kontrak,
                    'role'              => 'leader_finance',
                    'image'             => $query->image,
                    'jatah_cuti'        => $query->jatah_cuti,
                    'is_login'          => true,
                ];
            } else {
                $sess_data = [
                    'nip'               => $query->nip,
                    'name'              => $query->nama,
                    'email'             => $query->email,
                    'tempat_lahir'      => $query->tempat_lahir,
                    'tgl_lahir'         => $query->tgl_lahir,
                    'jenis_kelamin'     => $query->jenis_kelamin,
                    'agama'             => $query->agama,
                    'status'            => $query->status,
                    'status_pegawai'    => $query->status_pegawai,
                    'alamat'            => $query->alamat,
                    'nohp'              => $query->nohp,
                    'pendidikan'        => $query->pendidikan,
                    'nama_divisi'       => $query->nama_divisi,
                    'nama_jabatan'      => $query->nama_jabatan,
                    'nama_level'        => $query->nama_level,
                    'tgl_masuk'         => $query->tgl_masuk,
                    'tgl_mulai_kontrak' => $query->tgl_mulai_kontrak,
                    'tgl_akhir_kontrak' => $query->tgl_akhir_kontrak,
                    'role'              => 'pegawai',
                    'image'             => $query->image,
                    'jatah_cuti'        => $query->jatah_cuti,
                    'is_login'          => true,
                ];
            }


            $this->session->set_userdata($sess_data);
            return true;
        }
        return false;
    }
}

/* End of file Login_model.php */
