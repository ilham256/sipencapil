<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KatkinModel;
use App\Models\KinumumModel;
use App\Models\KurikulumTerpilihModel;
use CodeIgniter\Controller;

class Kinumum extends Controller
{ 
    protected $mahasiswaModel;
    protected $katkinModel;
    protected $kinumumModel;
    protected $kurikulumTerpilihModel;
    protected $session;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->katkinModel = new KatkinModel();
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
        $data['breadcrumbs'] = 'kinumum';
        $data['content'] = 'vw_kinerja_umum_rev_3';

        $kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();

        $simpan_tahun = $this->mahasiswaModel->getTahunMasukMin();
        $tahun = 2019;

        $data['simpanan_tahun'] = $tahun;
        $data['t_simpanan_tahun'] = ($simpan_tahun[0]->tahun_masuk) + 1;
        $data['data_cpl'] = $this->kinumumModel->getCpl($data['kurikulum_terpilih']);

        usort($data['data_cpl'], function($a, $b) {
            // Ambil angka dari id_cpl_langsung untuk dibandingkan
            $a_number = (int) str_replace('CPL_', '', $a->id_cpl);
            $b_number = (int) str_replace('CPL_', '', $b->id_cpl);
            
            return $a_number - $b_number;
        });

        $data['list_cpl'] = [];
        foreach ($data['data_cpl'] as $key) {
            array_push($data['list_cpl'], $key->nama);
        }

        $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor($data['kurikulum_terpilih']);

        


        $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmkKurikulumTerpilih($data['kurikulum_terpilih']);
        

        if ($this->request->getPost('pilih')) {
            $tahun = $this->request->getPost('tahun_masuk');
            $data['simpanan_tahun'] = $tahun;
            $data['t_simpanan_tahun'] = ((int)$tahun) + 1;
        }

        $nilai_std_max = [];
        $nilai_std_min = [];
        $nilai_cpl_average = [];
        $nilai_cpl_mahasiswa = [];
        $data['jumlah'] = [];

        $mahasiswa_2 = $this->kinumumModel->getMahasiswaTahun($tahun);
        $mahasiswa = [];

        $nilai_cpmk = $this->kinumumModel->getNilaiCpmkAngkatan($tahun);

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

        //dd($mahasiswa, $nilai_cpmk, $rumus_deskriptor, $rumus_cpl);
        foreach ($data['data_cpl'] as $key_0) {
            $dt = [];
            foreach ($mahasiswa as $key) {
                $n = 0;
                foreach ($nilai_cpmk as $key_2) {
                    if ($key["Nim"] == $key_2->nim) {
                        $n_1 = 0;
                        foreach ($rumus_cpl as $key_4) {
                            if ($key_0->id_cpl_langsung == $key_4->id_cpl_langsung) {
                                foreach ($rumus_deskriptor as $key_3) {
                                    if ($key_4->id_cpl_rumus_deskriptor == $key_3->id_deskriptor) {
                                        if ($key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
                                            $n_1 += $key_4->persentasi * $key_2->nilai_langsung * $key_3->persentasi;
                                        }
                                    }
                                }
                            }
                        }
                        $n += $n_1;
                    }
                }
                array_push($dt, $n);
            }
            $j = 0;
            foreach ($dt as $k) {
                if ($k > 0.0) {
                    $j += 1;
                }
            }

            if ($j == 0) {
                $j = 1;
            }

            $dt_avg = array_sum($dt) / $j;

            if ($dt_avg < 50) {
                $dt_avg = 50;
            }

            array_push($nilai_cpl_mahasiswa, $dt);
            array_push($nilai_cpl_average, $dt_avg);
            array_push($nilai_std_max, $dt_avg + 5);
            array_push($nilai_std_min, $dt_avg - 5);
            array_push($data['jumlah'], $j);
        }

        $target = $this->katkinModel->getKatkin();
        $data['target'] = ($target[0]->nilai_target_pencapaian_cpl);
        $data['target_cpl'] = $target;
        $data['nilai_cpl'] = $nilai_cpl_average;
        $data['nilai_std_max'] = $nilai_std_max;
        $data['nilai_std_min'] = $nilai_std_min;
        $data['nilai_cpl_mahasiswa'] = $nilai_cpl_mahasiswa;

        //dd($data);

        return view('vw_template', $data);
    }
}
