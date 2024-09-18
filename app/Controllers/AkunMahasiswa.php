<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class AkunMahasiswa extends BaseController
{
    protected $dosenModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        
        if (!$this->session->get('loggedin')) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'akun';
        $data['content'] = 'vw_akun_mahasiswa';
        $data['datas'] = $this->session->get();

        // echo '<pre>';  var_dump($this->session->get()); echo '</pre>';

        return view('vw_template_mahasiswa', $data);
    }

    public function ganti_password()
    {
        $data['breadcrumbs'] = 'akun';
        $data['content'] = 'vw_akun_ganti_password_mahasiswa';
        $data['konfirmasi'] = 'masuk';
        // echo '<pre>';  var_dump($data); echo '</pre>';
        return view('vw_template_mahasiswa', $data);
    }

    public function submit_ganti_password()
    {
        if ($this->request->getPost('simpan')) {

            $password_baru = $this->request->getPost('password_baru', FILTER_SANITIZE_STRING);
            $konfirmasi_password_baru = $this->request->getPost('konfirmasi_password_baru', FILTER_SANITIZE_STRING);

            if ($password_baru != $konfirmasi_password_baru) {
                $data['konfirmasi'] = 'salah';
            } else {
                $save_data = [
                    'password' => password_hash($password_baru, PASSWORD_DEFAULT),
                ];
                $id = $this->session->get('id');
                $query = $this->userModel->updatePassword($save_data, $id);

                $data['konfirmasi'] = 'benar';
            }

            $data['breadcrumbs'] = 'akun';
            $data['content'] = 'vw_akun_ganti_password_mahasiswa';
            // echo '<pre>';  var_dump($data); echo '</pre>';
            return view('vw_template_mahasiswa', $data);
        }
    }
}
