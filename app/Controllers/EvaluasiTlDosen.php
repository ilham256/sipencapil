<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;
use App\Models\EvaluasiTlModel;
use App\Models\KatkinModel;

class EvaluasiTlDosen extends BaseController
{
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $evaluasiTlModel;
    protected $katkinModel;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->evaluasiTlModel = new EvaluasiTlModel();
        $this->katkinModel = new KatkinModel();
        
        if (!session()->get('loggedin') || session()->get('level') != 1) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $arr['breadcrumbs'] = 'evaluasi_tl';
        $arr['content'] = 'vw_evaluasi_tl';

        $arr['data_semester'] = $this->matakuliahModel->getSemester();
        $arr['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();
        $arr['tahun_masuk_max'] = $this->mahasiswaModel->getTahunMasukMax();
        $arr['katkin'] = $this->katkinModel->getKatkin();

        $tahun_min = ($arr['tahun_masuk'][0]->tahun_masuk);
        $tahun_max = ($arr['tahun_masuk_max'][0]->tahun_masuk);

        $arr['simpanan_tahun_min'] = $tahun_min;
        $arr['t_simpanan_tahun_min'] = ((int)$tahun_min) + 1;
        $arr['simpanan_tahun_max'] = $tahun_max;
        $arr['t_simpanan_tahun_max'] = ((int)$tahun_max) + 1;

        if ($this->request->getPost('pilih')) {
            $tahun_min = $this->request->getPost('tahun_masuk_min');
            $arr['simpanan_tahun_min'] = $tahun_min;
            $arr['t_simpanan_tahun_min'] = ((int)$tahun_min) + 1;

            $tahun_max = $this->request->getPost('tahun_masuk_max');
            $arr['simpanan_tahun_max'] = $tahun_max;
            $arr['t_simpanan_tahun_max'] = ((int)$tahun_max) + 1;
        }

        $arr['tahun_masuk_select'] = $this->evaluasiTlModel->getTahunMasukSelect($tahun_min, $tahun_max);
        $select_tahun = [];
        foreach ($arr['tahun_masuk_select'] as $key) {
            $select_tahun[] = $key->tahun_masuk;
        }

        $arr['cpl_1'] = [];
        $arr['cpl_2'] = [];
        $arr['cpl_3'] = [];
        $arr['cpl_4'] = [];
        $arr['cpl_5'] = [];
        $arr['cpl_6'] = [];
        $arr['cpl_7'] = [];
        $arr['cpl_8'] = [];

        foreach ($select_tahun as $key) {
            $nilai_cpl_1 = $this->evaluasiTlModel->getAvgCpl1($key);
            $nilai_cpl_2 = $this->evaluasiTlModel->getAvgCpl2($key);
            $nilai_cpl_3 = $this->evaluasiTlModel->getAvgCpl3($key);
            $nilai_cpl_4 = $this->evaluasiTlModel->getAvgCpl4($key);
            $nilai_cpl_5 = $this->evaluasiTlModel->getAvgCpl5($key);
            $nilai_cpl_6 = $this->evaluasiTlModel->getAvgCpl6($key);
            $nilai_cpl_7 = $this->evaluasiTlModel->getAvgCpl7($key);
            $nilai_cpl_8 = $this->evaluasiTlModel->getAvgCpl8($key);

            $arr['cpl_1'][] = (int)($nilai_cpl_1[0]->cpl_1);
            $arr['cpl_2'][] = (int)($nilai_cpl_2[0]->cpl_2);
            $arr['cpl_3'][] = (int)($nilai_cpl_3[0]->cpl_3);
            $arr['cpl_4'][] = (int)($nilai_cpl_4[0]->cpl_4);
            $arr['cpl_5'][] = (int)($nilai_cpl_5[0]->cpl_5);
            $arr['cpl_6'][] = (int)($nilai_cpl_6[0]->cpl_6);
            $arr['cpl_7'][] = (int)($nilai_cpl_7[0]->cpl_7);
            $arr['cpl_8'][] = (int)($nilai_cpl_8[0]->cpl_8);
        }

        // Load the view
        return view('vw_template_dosen', $arr);
    }
}
?>
