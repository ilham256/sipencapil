<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function __construct()
    {
        //parent::__construct();
        
        // Memeriksa apakah pengguna sudah login dan memiliki level admin (level = 0)
        if (!session()->get('loggedin') || session()->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit();  // Redirect ke halaman login jika tidak memenuhi kriteria
        }
    }

    public function index()
    {
        $data = [
            'breadcrumbs' => 'Dashboard',
            'content' => 'vw_Beranda' // Sesuaikan dengan nama view yang benar
        ];

        return view('vw_template', $data); // Memuat view 'vw_template' dengan data yang telah disiapkan
    }
}

?>
