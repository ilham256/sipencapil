<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardOperator extends BaseController
{
    public function __construct()
    {
        // Memuat session service
        $this->session = \Config\Services::session();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 3) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'Dashboard';
        $data['content'] = 'vw_Beranda';

        return view('vw_template_operator', $data);
    }
}
