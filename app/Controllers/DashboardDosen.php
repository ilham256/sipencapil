<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardDosen extends Controller
{
    public function __construct()
    {
        // Memuat session service
        $this->session = \Config\Services::session();

        $this->dosen_model = new \App\Models\DosenModel();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 1) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'Dashboard';
        $data['content'] = 'vw_Beranda';

        // 1. Ambil ID dari session yang sedang aktif
        $id_dosen = session()->get('id');

        $data_dosen = $this->dosen_model->selectdosen($id_dosen);

        if($data_dosen) {
                // 3. Timpa (Update) session nama_user dengan nama asli
            session()->set('nama_dosen', $data_dosen["nama_dosen"]);
        }

        //$data_sesion = session()->get();
        // Menampilkan ke layar dan menghentikan eksekusi script (debugging)
        //dd($data_sesion);

        return view('vw_template_dosen', $data);
    }

    public function infumum()
    {
        $data['breadcrumbs'] = 'infumum';
        $data['content'] = 'vw_informasi_umum';

        return view('vw_template_dosen', $data);
    }
}
