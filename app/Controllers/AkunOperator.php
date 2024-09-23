<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\UserModel;

class AkunOperator extends BaseController
{
    protected $dosenModel; 
    protected $userModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->userModel = new UserModel();

        helper('session');

        if (!session()->get('loggedin')) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data = [
            'breadcrumbs' => 'akun',
            'content' => 'vw_akun_operator',
            'datas' => session()->get()
        ];

        return view('vw_template_operator', $data);
    }

    public function ganti_password()
    {
        $data = [
            'breadcrumbs' => 'akun',
            'content' => 'vw_akun_ganti_password_operator',
            'konfirmasi' => 'masuk'
        ];

        return view('vw_template_operator', $data);
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
                $id = session()->get('id');
                $this->userModel->updatePassword($save_data, $id);

                $data['konfirmasi'] = 'benar';
            }

            $data['breadcrumbs'] = 'akun';
            $data['content'] = 'vw_akun_ganti_password_operator';

            return view('vw_template_operator', $data);
        }
    }
}
