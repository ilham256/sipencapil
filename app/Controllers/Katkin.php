<?php

namespace App\Controllers;

use App\Models\KatkinModel;
use CodeIgniter\Controller;

class Katkin extends BaseController
{
    protected $katkinModel;
    protected $session;

    public function __construct()
    {
        $this->katkinModel = new KatkinModel();
        $this->session = \Config\Services::session();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $edit = $this->katkinModel->getKatkin();
        foreach ($edit as $row) {
            $arr = [
                'data' => $row
            ];
        }
        $arr['breadcrumbs'] = 'katkin';
        $arr['content'] = 'vw_kategori_kinerja_info';

        echo view('vw_template', $arr);
    }

    public function editKatkin()
    {
        $edit = $this->katkinModel->getKatkin();
        foreach ($edit as $row) {
            $arr = [
                'data' => $row
            ];
        }
        $arr['breadcrumbs'] = 'katkin';
        $arr['content'] = 'vw_kategori_kinerja';

        echo view('vw_template', $arr);
    }

    public function simpanData()
    {
        if ($this->request->getPost('simpan')) {
            $saveData = [
                'batas_bawah_kategori_cukup_cpl' => $this->request->getPost('batas_bawah_kategori_cukup_cpl'),
                'target_jumlah_mahasiswa_cukup_cpl' => $this->request->getPost('target_jumlah_mahasiswa_cukup_cpl'),
                'batas_bawah_kategori_baik_cpl' => $this->request->getPost('batas_bawah_kategori_baik_cpl'),
                'target_jumlah_mahasiswa_baik_cpl' => $this->request->getPost('target_jumlah_mahasiswa_baik_cpl'),
                'batas_bawah_kategori_sangat_baik_cpl' => $this->request->getPost('batas_bawah_kategori_sangat_baik_cpl'),
                'target_jumlah_mahasiswa_sangat_baik_cpl' => $this->request->getPost('target_jumlah_mahasiswa_sangat_baik_cpl'),
                'nilai_target_pencapaian_cpl' => $this->request->getPost('nilai_target_pencapaian_cpl'),
                'batas_bawah_kategori_cukup_cpmk' => $this->request->getPost('batas_bawah_kategori_cukup_cpmk'),
                'batas_bawah_kategori_baik_cpmk' => $this->request->getPost('batas_bawah_kategori_baik_cpmk'),
                'batas_bawah_kategori_sangat_baik_cpmk' => $this->request->getPost('batas_bawah_kategori_sangat_baik_cpmk'),
                'nilai_target_pencapaian_cpmk' => $this->request->getPost('nilai_target_pencapaian_cpmk')
            ];    
            $id = $this->request->getPost('id');
            $query = $this->katkinModel->submitEdit($saveData, $id);
            if ($query) {
                session()->setFlashdata('success','Data berhasil diedit!');
                return redirect()->to('katkin');
            }
        }
    }

    public function suksesSimpan()
    {
        $arr['breadcrumbs'] = 'dosen';
        $arr['content'] = 'vw_data_berhasil_disimpan';

        echo view('vw_template', $arr);
    }
}
