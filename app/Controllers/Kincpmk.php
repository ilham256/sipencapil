<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;
use App\Models\KincpmkModel;
use App\Models\KinumumModel;
use App\Models\KurikulumTerpilihModel;
use CodeIgniter\Controller;

class Kincpmk extends Controller
{ 
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $kincpmkModel;
    protected $kinumumModel;
    protected $kurikulumTerpilihModel;
    protected $session;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kincpmkModel = new KincpmkModel();
        $this->kinumumModel = new KinumumModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();
        $this->session = session();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'kincpmk';
        $data['content'] = 'vw_kinerja_cpmk';
        $data['data_semester'] = $this->matakuliahModel->getSemester();
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();

        $kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

        //$data['cpmklang'] = $this->kincpmkModel->getCpmklangKurikulumTerpilih($data['kurikulum_terpilih']); 

        $semester = ($data['data_semester'][2]->id_semester);
        $tahun = ($data['tahun_masuk'][0]->tahun_masuk);
        $tahun = 2019; 

        $data['simpanan_tahun'] = $tahun;
        $data['simpanan_semester'] = $semester;
        $data['t_simpanan_tahun'] = ((int)$tahun) + 1;

        $data['mk_cpmk'] = [];
        $data['nilai_cpmk'] = [];

        if ($this->request->getPost('pilih')) {
            $tahun = $this->request->getPost('tahun_masuk');
            $data['simpanan_tahun'] = $tahun;
            $data['t_simpanan_tahun'] = ((int)$tahun) + 1;

            $semester = $this->request->getPost('semester');
            $data['simpanan_semester'] = $semester;
        }

        $mahasiswa_2 = $this->kinumumModel->getMahasiswaTahun($tahun);
        $mahasiswa = [];

        foreach ($mahasiswa_2 as $key) {
            $data_m = [
                "Nim" => $key->nim,
                "Nama" => $key->nama,
                "SemesterMahasiswa" => $key->SemesterMahasiswa,
                "StatusAkademik" => $key->StatusAkademik,
                "tahun" => $key->tahun_masuk
            ];
            array_push($mahasiswa, $data_m);
        }

        $data['mata_kuliah'] = $this->matakuliahModel->getSelectMatakuliah($semester,$data['kurikulum_terpilih']);
        $kode_mk = [];
        foreach ($data['mata_kuliah'] as $key) {
            array_push($kode_mk, $key->kode_mk);
        }

        foreach ($kode_mk as $key) {
            $mk_cpmk = $this->kincpmkModel->getMkCpmk($key);

            $t_mk_cpmk = [];
            $t_n_cpmk = [];

            foreach ($mk_cpmk as $key) {
                array_push($t_mk_cpmk, $key->id_cpmk_langsung);
                $n_cpmk = [];
                foreach ($mahasiswa_2 as $key_4) {
                    $n_cpmk_1 = $this->kincpmkModel->getNilaiCpmkSelect($key_4->nim . "_" . $key->id_matakuliah_has_cpmk);

                    if (!empty($n_cpmk_1)) {
                        $n_cpmk_2 = $n_cpmk_1[0];
                        $n_cpmk_1 = $n_cpmk_2;
                    }

                    array_push($n_cpmk, $n_cpmk_1);
                }

                if (empty($n_cpmk)) {
                    $n_cpmk = 0;
                }

                if ($n_cpmk == 0) {
                    array_push($t_n_cpmk, $n_cpmk);
                } else {
                    $nilai_sementara = [];
                    foreach ($n_cpmk as $key_2) {
                        if (!empty($key_2)) {
                            array_push($nilai_sementara, $key_2->nilai_langsung);
                        }
                    }
                    if (count($nilai_sementara) == 0) {
                        $average = 0;
                    } else {
                        $average = array_sum($nilai_sementara) / count($nilai_sementara);
                    }

                    array_push($t_n_cpmk, round($average));
                }
            }

            array_push($data['mk_cpmk'], $t_mk_cpmk);
            array_push($data['nilai_cpmk'], $t_n_cpmk);
        }

        return view('vw_template', $data);
    }
}
