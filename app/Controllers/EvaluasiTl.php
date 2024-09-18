<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;
use App\Models\EvaluasiTlModel;
use App\Models\KatkinModel;

class EvaluasiTl extends BaseController
{
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $evaluasiTlModel;
    protected $katkinModel;

    public function __construct()
    {
        // Load models
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->evaluasiTlModel = new EvaluasiTlModel();
        $this->katkinModel = new KatkinModel();

        // Check session
        if (!session()->get('loggedin') || session()->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'evaluasi_tl';
        $data['content'] = 'vw_evaluasi_tl';

        $data['data_semester'] = $this->matakuliahModel->getSemester();
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();
        $data['tahun_masuk_max'] = $this->mahasiswaModel->getTahunMasukMax();
        $data['katkin'] = $this->katkinModel->getKatkin();

        $tahunMin = $data['tahun_masuk'][0]->tahun_masuk;
        $tahunMax = $data['tahun_masuk_max'][0]->tahun_masuk;

        $data['simpanan_tahun_min'] = $tahunMin;
        $data['t_simpanan_tahun_min'] = ((int) $tahunMin) + 1;
        $data['simpanan_tahun_max'] = $tahunMax;
        $data['t_simpanan_tahun_max'] = ((int) $tahunMax) + 1;

        if ($this->request->getPost('pilih')) {
            $tahunMin = $this->request->getPost('tahun_masuk_min', FILTER_SANITIZE_STRING);
            $data['simpanan_tahun_min'] = $tahunMin;
            $data['t_simpanan_tahun_min'] = ((int) $tahunMin) + 1;

            $tahunMax = $this->request->getPost('tahun_masuk_max', FILTER_SANITIZE_STRING);
            $data['simpanan_tahun_max'] = $tahunMax;
            $data['t_simpanan_tahun_max'] = ((int) $tahunMax) + 1;
        }

        $data['tahun_masuk_select'] = $this->evaluasiTlModel->getTahunMasukSelect($tahunMin, $tahunMax);
        $selectTahun = [];
        foreach ($data['tahun_masuk_select'] as $key) {
            array_push($selectTahun, $key->tahun_masuk);
        }

        $data['cpl_1'] = [];
        $data['cpl_2'] = [];
        $data['cpl_3'] = [];
        $data['cpl_4'] = [];
        $data['cpl_5'] = [];
        $data['cpl_6'] = [];
        $data['cpl_7'] = [];
        $data['cpl_8'] = [];

        foreach ($selectTahun as $key) {
            $nilaiCpl1 = $this->evaluasiTlModel->getAvgCpl1($key);
            $nilaiCpl2 = $this->evaluasiTlModel->getAvgCpl2($key);
            $nilaiCpl3 = $this->evaluasiTlModel->getAvgCpl3($key);
            $nilaiCpl4 = $this->evaluasiTlModel->getAvgCpl4($key);
            $nilaiCpl5 = $this->evaluasiTlModel->getAvgCpl5($key);
            $nilaiCpl6 = $this->evaluasiTlModel->getAvgCpl6($key);
            $nilaiCpl7 = $this->evaluasiTlModel->getAvgCpl7($key);
            $nilaiCpl8 = $this->evaluasiTlModel->getAvgCpl8($key);

            $t1 = (int) $nilaiCpl1[0]->cpl_1;
            $t2 = (int) $nilaiCpl2[0]->cpl_2;
            $t3 = (int) $nilaiCpl3[0]->cpl_3;
            $t4 = (int) $nilaiCpl4[0]->cpl_4;
            $t5 = (int) $nilaiCpl5[0]->cpl_5;
            $t6 = (int) $nilaiCpl6[0]->cpl_6;
            $t7 = (int) $nilaiCpl7[0]->cpl_7;
            $t8 = (int) $nilaiCpl8[0]->cpl_8;

            array_push($data['cpl_1'], $t1);
            array_push($data['cpl_2'], $t2);
            array_push($data['cpl_3'], $t3);
            array_push($data['cpl_4'], $t4);
            array_push($data['cpl_5'], $t5);
            array_push($data['cpl_6'], $t6);
            array_push($data['cpl_7'], $t7);
            array_push($data['cpl_8'], $t8);
        }

        // Load the view with the data
        //dd($selectTahun, $data);
        echo view('vw_template', $data);
    }
}
