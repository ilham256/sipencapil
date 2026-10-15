<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KatkinModel;
use App\Models\KinumumModel;
use App\Models\KurikulumTerpilihModel;

class DataDosen extends BaseController
{
    protected $mahasiswaModel;
    protected $katkinModel;
    protected $kinumumModel;
    protected $kurikulumTerpilihModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->katkinModel = new KatkinModel();
        $this->kinumumModel = new KinumumModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();

        // Assuming you have a session library loaded in BaseController
        if (!session()->get('loggedin') || session()->get('level') != 1) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    } 


    public function data_kekurangan_nilai()
    {
        $arr['breadcrumbs'] = 'data_kekurangan_nilai';
        $arr['content'] = 'vw_data_kekurangan_nilai_dosen';

        $arr['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();

        $simpan_tahun = $this->mahasiswaModel->getTahunMasukMin();
        $tahun = 2017;

        $arr['simpanan_tahun'] = $tahun;
        $arr['t_simpanan_tahun'] = ($simpan_tahun[0]->tahun_masuk) + 1;

        //$nilai_cpmk = $this->kinumumModel->getNilaiCpmkSelect();

        if ($this->request->getPost('pilih')) {
            $tahun = $this->request->getPost('tahun');
            $arr['simpanan_tahun'] = $tahun;
            $arr['t_simpanan_tahun'] = ((int)$tahun) + 1;
        }

        $target = $this->katkinModel->getKatkin();
        $arr['target'] = $target[0]->nilai_target_pencapaian_cpmk;

        $arr['nilai_cpmk_kurang'] = $this->kinumumModel->getNilaiCpmkKurang($tahun,$arr['target']);
        //dd($arr['nilai_cpmk_kurang']);

        //dd($arr, $rumus_cpl, $rumus_deskriptor);

        return view('vw_template_dosen', $arr);
    }
}
