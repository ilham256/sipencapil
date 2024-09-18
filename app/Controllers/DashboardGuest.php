<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KatkinModel;
use App\Models\KinumumModel;
use App\Models\MatakuliahModel;
use App\Models\KincpmkModel;
use App\Models\KincplModel;

class DashboardGuest extends BaseController
{
    protected $mahasiswaModel;
    protected $katkinModel;
    protected $kinumumModel;
    protected $matakuliahModel;
    protected $kincpmkModel;
    protected $kincplModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->katkinModel = new KatkinModel();
        $this->kinumumModel = new KinumumModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->kincpmkModel = new KincpmkModel();
        $this->kincplModel = new KincplModel();

        if (session()->get('loggedin') != true || session()->get('level') != 4) {
           header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'Dashboard';
        $data['content'] = 'vw_Beranda';

        return view('vw_template_guest', $data);
    }

    public function infumum()
    {
        $data['breadcrumbs'] = 'infumum';
        $data['content'] = 'vw_informasi_umum';

        return view('vw_template_guest', $data);
    }

    public function kinumum()
    {
        $data['breadcrumbs'] = 'kinumum';
        $data['content'] = 'login_guest/vw_kinerja_umum_rev_3';
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();

        $simpan_tahun = $this->mahasiswaModel->getTahunMasukMin();
        $tahun = 2018;

        $data['simpanan_tahun'] = $tahun;
        $data['t_simpanan_tahun'] = ($simpan_tahun[0]->tahun_masuk) + 1;
        $data['data_cpl'] = $this->kinumumModel->getCpl();

        $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor();
        $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk();
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

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
                                    if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
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
        
        return view('vw_template_guest', $data);
    }

    public function kincpmk()
    {
        $data['breadcrumbs'] = 'kincpmk';
        $data['content'] = 'login_guest/vw_kinerja_cpmk';
        $data['data_semester'] = $this->matakuliahModel->getSemester();
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();
        $data['cpmklang'] = $this->kincpmkModel->getCpmklang();

        $semester = ($data['data_semester'][2]->id_semester);
        $tahun = ($data['tahun_masuk'][0]->tahun_masuk);
        $tahun = 2018;

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

        function curl($url)
        {
            $ch = curl_init();
            $headers = [
                'accept: text/plain',
                'X-IPBAPI-TOKEN: Bearer 86f2760d-7293-36f4-833f-1d29aaace42e'
            ];
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }

        $send = curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=" . $tahun);

        $mahasiswa = json_decode($send, true);

        $data['mata_kuliah'] = $this->matakuliahModel->getSelectMatakuliah($semester);
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
                foreach ($mahasiswa as $key_4) {
                    $n_cpmk_1 = $this->kincpmkModel->getNilaiCpmk($key->id_matakuliah_has_cpmk, $key_4["NIM"]);
                    array_push($n_cpmk, $n_cpmk_1[0]->nilai_langsung);
                }
                array_push($t_n_cpmk, $n_cpmk);
            }
            array_push($data['mk_cpmk'], $t_mk_cpmk);
            array_push($data['nilai_cpmk'], $t_n_cpmk);
        }

        return view('vw_template_guest', $data);
    }

    public function kincpl()
    {
        $data['breadcrumbs'] = 'kincpl';
        $data['content'] = 'login_guest/vw_kinerja_cpl';
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();

        $simpan_tahun = $this->mahasiswaModel->getTahunMasukMin();
        $tahun = 2018;

        $data['simpanan_tahun'] = $tahun;
        $data['t_simpanan_tahun'] = ($simpan_tahun[0]->tahun_masuk) + 1;
        $data['data_cpl'] = $this->kincplModel->getCpl();

        $rumus_cpl = $this->kincplModel->getCplRumusDeskriptor();
        $rumus_deskriptor = $this->kincplModel->getDeskriptorRumusCpmk();
        $nilai_cpmk = $this->kincplModel->getNilaiCpmk();

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

        $mahasiswa_2 = $this->kincplModel->getMahasiswaTahun($tahun);
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
                                    if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
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
        
        return view('vw_template_guest', $data);
    }
}
