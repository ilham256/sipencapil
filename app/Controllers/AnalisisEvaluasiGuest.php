<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;
use App\Models\EvaluasiLModel;
use App\Models\KatkinModel;
use App\Models\KinumumModel;
use App\Models\KincplModel;
use App\Models\ReportModel;
use App\Models\EvaluasiTlModel;

class AnalisisEvaluasiGuest extends BaseController
{
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $evaluasiLModel;
    protected $katkinModel;
    protected $kinumumModel;
    protected $kincplModel;
    protected $reportModel;
    protected $evaluasiTlModel;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->evaluasiLModel = new EvaluasiLModel();
        $this->katkinModel = new KatkinModel();
        $this->kinumumModel = new KinumumModel();
        $this->kincplModel = new KincplModel();
        $this->reportModel = new ReportModel();
        $this->evaluasiTlModel = new EvaluasiTlModel();

        if (!session()->get('loggedin') || session()->get('level') != 4) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function evaluasi_l()
    {
        $data['breadcrumbs'] = 'evaluasi_l';
        $data['content'] = 'login_guest/analisis_evaluasi_pengukuran_langsung/analisis_kinerja_cpl_vw';

        $data['data_semester'] = $this->matakuliahModel->getSemester();
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();
        $data['tahun_masuk_max'] = $this->mahasiswaModel->getTahunMasukMax();
        $data['katkin'] = $this->katkinModel->getKatkin();
        $data['data_cpl'] = $this->kinumumModel->getCpl();
        $data['nama_cpl'] = array_column($data['data_cpl'], 'nama');

        $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor();
        $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk();
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

        $tahun_min = 2017;
        $tahun_max = 2019;
        $target = $this->katkinModel->getKatkin();

        $data['simpanan_tahun_min'] = $tahun_min;
        $data['t_simpanan_tahun_min'] = $tahun_min + 1;
        $data['simpanan_tahun_max'] = $tahun_max;
        $data['t_simpanan_tahun_max'] = $tahun_max + 1;

        if ($this->request->getPost('pilih')) {
            $tahun_min = $this->request->getPost('tahun_masuk_min');
            $data['simpanan_tahun_min'] = $tahun_min;
            $data['t_simpanan_tahun_min'] = $tahun_min + 1;

            $tahun_max = $this->request->getPost('tahun_masuk_max');
            $data['simpanan_tahun_max'] = $tahun_max;
            $data['t_simpanan_tahun_max'] = $tahun_max + 1;
        }

        $data['tahun_masuk_select'] = range($tahun_min, $tahun_max - 1);

        $nilai_cpl_mahasiswa = [];
        $nilai_cpl_average = [];
        $nilai_std_max = [];
        $nilai_std_min = [];
        $nilai_target = [];

        foreach ($data['tahun_masuk_select'] as $tahun) {
            $nilai_std_max_1 = [];
            $nilai_std_min_1 = [];
            $nilai_cpl_average_1 = [];
            $nilai_cpl_mahasiswa_1 = [];
            $target_1 = [];

            $mahasiswa = $this->curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=" . $tahun);

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
                                        if ($key_4->id_deskriptor == $key_3->id_deskriptor && $key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
                                            $n_1 += $key_4->persentasi * $key_2->nilai_langsung * $key_3->persentasi;
                                        }
                                    }
                                }
                            }
                            $n += $n_1;
                        }
                    }
                    $dt[] = $n;
                }
                $j = count(array_filter($dt));
                $j = $j == 0 ? 1 : $j;
                $dt_avg = array_sum($dt) / $j;

                $nilai_cpl_mahasiswa_1[] = $dt;
                $nilai_cpl_average_1[] = round($dt_avg);
                $nilai_std_max_1[] = $dt_avg + 5;
                $nilai_std_min_1[] = $dt_avg - 5;
                $target_1[] = $target[0]->nilai_target_pencapaian_cpl;
            }

            $nilai_cpl_mahasiswa[] = $nilai_cpl_mahasiswa_1;
            $nilai_cpl_average[] = $nilai_cpl_average_1;
            $nilai_std_max[] = $nilai_std_max_1;
            $nilai_std_min[] = $nilai_std_min_1;
            $nilai_target[] = $target_1;
        }

        $data['target'] = $nilai_target;
        $data['nilai_cpl'] = $nilai_cpl_average;
        $data['nilai_std_max'] = $nilai_std_max;
        $data['nilai_std_min'] = $nilai_std_min;

        return view('vw_template_guest', $data);
    }

    private function curl($url)
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
        return json_decode($output, true);
    }

    public function evaluasi_kinerja_cpl()
    {
        $data['breadcrumbs'] = 'evaluasi_l';
        $data['content'] = 'login_guest/analisis_evaluasi_pengukuran_langsung/evaluasi_kinerja_cpl_vw';
        $data['semester'] = $this->kincplModel->getSemester();
        $data['cpl'] = $this->kincplModel->getCpl();
        $data['simpanan_cpl'] = $data['cpl'][7]->id_cpl_langsung;
        $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor();
        $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk();
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();
        $data['simpanan_tahun'] = $data['tahun_masuk'][0]->tahun_masuk;
        $data['t_simpanan_tahun'] = $data['tahun_masuk'][0]->tahun_masuk + 1;
        $target = $this->katkinModel->getKatkin();
        $target_cpl = $target[0]->nilai_target_pencapaian_cpl;

        $data['tahun'] = 2017;

        if ($this->request->getPost('pilih')) {
            $data['tahun'] = $this->request->getPost('tahun');
            $data['simpanan_cpl'] = $this->request->getPost('cpl');
        }

        $mahasiswa = $this->curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=" . $data['tahun']);

        $nilai_target = [];
        $nilai_cpl_mahasiswa = [];
        $nilai_cpl_average = [];
        $nilai_std_max = [];
        $nilai_std_min = [];
        foreach ($mahasiswa as $key) {
            $n = 0;
            foreach ($nilai_cpmk as $key_2) {
                if ($key["Nim"] == $key_2->nim) {
                    $n_1 = 0;
                    foreach ($rumus_cpl as $key_4) {
                        if ($data['simpanan_cpl'] == $key_4->id_cpl_langsung) {
                            foreach ($rumus_deskriptor as $key_3) {
                                if ($key_4->id_deskriptor == $key_3->id_deskriptor && $key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
                                    $n_1 += $key_4->persentasi * $key_2->nilai_langsung * $key_3->persentasi;
                                }
                            }
                        }
                    }
                    $n += $n_1;
                }
            }
            $nilai_cpl_mahasiswa[] = $n;
        }

        $j = count(array_filter($nilai_cpl_mahasiswa));
        $j = $j == 0 ? 1 : $j;
        $dt_avg = array_sum($nilai_cpl_mahasiswa) / $j;
        $nilai_cpl_average[] = round($dt_avg);
        $nilai_std_max[] = $dt_avg + 5;
        $nilai_std_min[] = $dt_avg - 5;
        $nilai_target[] = $target_cpl;

        $data['nilai_cpl_mahasiswa'] = $nilai_cpl_mahasiswa;
        $data['nilai_target'] = $nilai_target;
        $data['nilai_cpl'] = $nilai_cpl_average;
        $data['nilai_std_max'] = $nilai_std_max;
        $data['nilai_std_min'] = $nilai_std_min;

        return view('vw_template_guest', $data);
    }
}
