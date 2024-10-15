<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;
use App\Models\KincpmkModel;
use App\Models\ReportModel;
use App\Models\KatkinModel;
use App\Models\KinumumModel;
use App\Models\KincplModel;
use App\Models\EpbmModel;
use App\Models\KurikulumTerpilihModel;

class ReportDosen extends BaseController
{
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $kincpmkModel;
    protected $reportModel;
    protected $katkinModel;
    protected $kinumumModel;
    protected $kincplModel;
    protected $epbmModel;
	protected $kurikulumTerpilihModel;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kincpmkModel = new KincpmkModel();
        $this->reportModel = new ReportModel();
        $this->katkinModel = new KatkinModel();
        $this->kinumumModel = new KinumumModel();
        $this->kincplModel = new KincplModel();
        $this->epbmModel = new EpbmModel();
		$this->kurikulumTerpilihModel = new KurikulumTerpilihModel();

		if (!session()->get('loggedin') || session()->get('level') != 1) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }
 
    public function index()
    {
        

        $arr['breadcrumbs'] = 'report';
        $arr['content'] = 'vw_reportdosen'; 

        $arr['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
        $arr['katkin'] = $this->katkinModel->getKatkin();
        
		$arr['data_mahasiswa'] = $this->mahasiswaModel->getMahasiswa();

        // Sub Menu Kinerja CPL Mahasiswa
        $arr['semester'] = $this->kincplModel->getSemester();
        $arr['nim_3'] = 'F44190002';

		$arr['cpl'] = $this->kincplModel->getCpl();
        
        $arr['simpanan_cpl'] = ($arr['cpl']["7"]->id_cpl_langsung);

		$arr['status'] = "sembunyikan";

        
        
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

        $target = $this->katkinModel->getKatkin();
        $target_cpl = ($target["0"]->nilai_target_pencapaian_cpl);

        if ($this->request->getPost('pilih_3')) {
            $nim_3 = $this->request->getPost('nim_3');
            $arr['nim_3'] = $nim_3;

            $cpl_1 = $this->request->getPost('cpl');
            $arr['simpanan_cpl'] = $cpl_1;

            $arr['status_aktif'] = '';
            $arr['status_aktif_2'] = '';
            $arr['status_aktif_3'] = 'show active';

            $arr['naf'] = '';
            $arr['naf_2'] = '';
            $arr['naf_3'] = 'active';

			$arr['status'] = "tampilkan";
        }

		//data simpanan CPL 
		$arr['data_simpanan_cpl'] = $this->kinumumModel->getdataCpl($arr['simpanan_cpl']);

		// Mengecek Kuikulum yang digunakan Mahasiswa
		$data_kurikulum_mahasiswa = $this->mahasiswaModel->getMahasiswaKurikulum($arr['nim_3']);
		$arr['kurikulum_mahasiswa'] = $data_kurikulum_mahasiswa[0]->kode_kurikulum;
		
		$arr['data_cpl'] = $this->kinumumModel->getCpl($arr['kurikulum_mahasiswa']);
		$arr['cpl'] = $this->kinumumModel->getCpl($arr['kurikulum_mahasiswa']);
		$rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor($arr['kurikulum_mahasiswa']);
		$rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmkKurikulumTerpilih($arr['kurikulum_mahasiswa']);

		//dd($rumus_deskriptor);
        // Perhitungan nilai target
        $nilai_target = [];
        $persentase_nilai_target = [];

        foreach ($arr['semester'] as $key_0) {
            $n_target = 0;
            foreach ($rumus_cpl as $key_4) {
                if ($arr['simpanan_cpl'] == $key_4->id_cpl_langsung) {
                    foreach ($rumus_deskriptor as $key_3) {
                        if ($key_4->id_cpl_rumus_deskriptor == $key_3->id_deskriptor && $key_0->id_semester == $key_3->id_semester) {
                            $n_target += $key_4->persentasi * $target_cpl * $key_3->persentasi;
                        }
                    }
                }
            }
            array_push($nilai_target, $n_target);
        }

        for ($i = 0; $i < count($nilai_target); $i++) {
            $pnt = 0;
            for ($p = 0; $p < $i + 1; $p++) {
                $pnt += $nilai_target[$p];
            }
            array_push($persentase_nilai_target, $pnt);
        }

        // Perhitungan nilai maksimal
        $nilai_maksimal = [];
        $persentase_nilai_maksimal = [];

        foreach ($arr['semester'] as $key_0) {
            $n_m = 0;
            foreach ($rumus_cpl as $key_4) {
                if ($arr['simpanan_cpl'] == $key_4->id_cpl_langsung) {
                    foreach ($rumus_deskriptor as $key_3) {
                        if ($key_4->id_cpl_rumus_deskriptor == $key_3->id_deskriptor && $key_0->id_semester == $key_3->id_semester) {
                            $n_m += $key_4->persentasi * 100 * $key_3->persentasi;
                        }
                    }
                }
            }
            array_push($nilai_maksimal, $n_m);
        }

        for ($i = 0; $i < count($nilai_maksimal); $i++) {
            $pnt = 0;
            for ($p = 0; $p < $i + 1; $p++) {
                $pnt += $nilai_maksimal[$p];
            }
            array_push($persentase_nilai_maksimal, $pnt);
        }

        // Perhitungan nilai mahasiswa
        $nilai_cpl_average = [];
        $nilai_cpl_mahasiswa = [];
        $nilai_capaian_mahasiswa = [];

        foreach ($arr['semester'] as $key_0) {
            $n = 0;
            foreach ($nilai_cpmk as $key_2) {
                if ($arr['nim_3'] == $key_2->nim) {
                    $n_1 = 0;
                    foreach ($rumus_cpl as $key_4) {
                        if ($arr['simpanan_cpl'] == $key_4->id_cpl_langsung) {
                            foreach ($rumus_deskriptor as $key_3) {
                                if ($key_4->id_cpl_rumus_deskriptor == $key_3->id_deskriptor && $key_0->id_semester == $key_3->id_semester && $key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
                                    $n_1 += $key_4->persentasi * $key_2->nilai_langsung * $key_3->persentasi;
                                }
                            }
                        }
                    }
                    $n += $n_1;
                }
            }
            array_push($nilai_cpl_average, $n);
        }
 
        for ($i = 0; $i < count($nilai_cpl_average); $i++) {
            $pnt = 0;
            for ($p = 0; $p < $i + 1; $p++) {
                $pnt += $nilai_cpl_average[$p];
            }
            array_push($nilai_capaian_mahasiswa, $pnt);
        }

        $arr['nama_mahasiswa'] = $this->reportModel->getNamaMahasiswa($arr['nim_3']);
        $arr['capaian'] = $nilai_capaian_mahasiswa;
        $arr['target'] = $persentase_nilai_target;
        $arr['nilai_tertinggi'] = $persentase_nilai_maksimal;
        $arr['nama_semester'] = [];
        foreach ($arr['semester'] as $key_0) {
            array_push($arr['nama_semester'], "Semester " . $key_0->nama);
        }

		
        // Load view
        return view('vw_template_dosen', $arr);
    }


	public function mahasiswa()
    {
        $data['breadcrumbs'] = 'report_mahasiswa';
        $data['content'] = 'reportdosen/vw_report_mahasiswa';

        $data['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
        $data['katkin'] = $this->katkinModel->getKatkin();
        
		$data['data_mahasiswa'] = $this->mahasiswaModel->getMahasiswa();

        $data['nilai_cpl_mahasiswa'] = [];
        $data['status_nilai_cpl_mahasiswa'] = [];
		$data['status'] = "";

        // Mengambil data mahasiswa dari API
        $currentYear = 2024;
        $startYear = 2019;
        $tahun_report = range($startYear, $currentYear - 1);

		$kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $arr['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

		$data['data_cpl'] = $this->kinumumModel->getCpl($arr['kurikulum_terpilih']);

		usort($data['data_cpl'], function($a, $b) {
            // Ambil angka dari id_cpl_langsung untuk dibandingkan
            $a_number = (int) str_replace('CPL_', '', $a->id_cpl);
            $b_number = (int) str_replace('CPL_', '', $b->id_cpl);
            
            return $a_number - $b_number;
        });
		

        // Sub Menu Rapor Mahasiswa
        
        
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

        $pilih_2 = $this->request->getPost('pilih_2');

        if (!empty($pilih_2)) {
            $data['status_aktif'] = '';
            $data['status_aktif_2'] = 'show active';
            $data['status_aktif_3'] = '';

            $data['naf'] = '';
            $data['naf_2'] = 'active';
            $data['naf_3'] = '';

            $nim_2 = $this->request->getPost('nim_2', FILTER_SANITIZE_STRING);
            $data['nim_2'] = $nim_2;
			$data['status'] = "tampilkan";
			//dd($data);
			// Mengecek Kuikulum yang digunakan Mahasiswa
			$data_kurikulum_mahasiswa = $this->mahasiswaModel->getMahasiswaKurikulum($data['nim_2']);
			$info_mahasiswa = $this->mahasiswaModel->getMahasiswaInfo($data['nim_2']);
			$data['kurikulum_mahasiswa'] = $data_kurikulum_mahasiswa[0]->kode_kurikulum;

			$data['data_cpl'] = $this->kinumumModel->getCpl($data['kurikulum_mahasiswa']);

			usort($data['data_cpl'], function($a, $b) {
				// Ambil angka dari id_cpl_langsung untuk dibandingkan
				$a_number = (int) str_replace('CPL_', '', $a->id_cpl);
				$b_number = (int) str_replace('CPL_', '', $b->id_cpl);
				
				return $a_number - $b_number;
			});

			$rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor($data['kurikulum_mahasiswa']);
			
			$rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmkKurikulumTerpilih($data['kurikulum_mahasiswa']);
			

			$data['nama_rapor_mahasiswa'] = $info_mahasiswa[0]->nama;
			$data['nim_rapor_mahasiswa'] = $info_mahasiswa[0]->nim;

            $batas_cukup = $data['katkin'][0]->batas_bawah_kategori_cukup_cpl;
            $batas_baik = $data['katkin'][0]->batas_bawah_kategori_baik_cpl;
            $batas_sangat_baik = $data['katkin'][0]->batas_bawah_kategori_sangat_baik_cpl;
			//dd($data,$rumus_cpl,$rumus_deskriptor);
            foreach ($data['data_cpl'] as $cpl) {
                $n = 0;
                foreach ($nilai_cpmk as $nilai) {
                    if ($data['nim_rapor_mahasiswa'] == $nilai->nim) {
                        $n_1 = 0;
                        foreach ($rumus_cpl as $rumus_cpl_item) {
                            if ($cpl->id_cpl_langsung == $rumus_cpl_item->id_cpl_langsung) {
                                foreach ($rumus_deskriptor as $rumus_deskriptor_item) {
                                    if ($rumus_cpl_item->id_cpl_rumus_deskriptor == $rumus_deskriptor_item->id_deskriptor) {
                                        if ($nilai->id_matakuliah_has_cpmk == $rumus_deskriptor_item->id_matakuliah_has_cpmk) {
                                            $n_1 += $rumus_cpl_item->persentasi * $nilai->nilai_langsung * $rumus_deskriptor_item->persentasi;
                                        }
                                    }
                                }
                            }
                        }
                        $n += $n_1;
                    }
                }
                array_push($data['nilai_cpl_mahasiswa'], $n);
            }

            foreach ($data['nilai_cpl_mahasiswa'] as $nilai_cpl) {
                if ($nilai_cpl > $batas_sangat_baik) {
                    $status_cpl_mahasiswa = 'Sangat Baik';
                } elseif ($nilai_cpl > $batas_baik) {
                    $status_cpl_mahasiswa = 'Baik';
                } elseif ($nilai_cpl > $batas_cukup) {
                    $status_cpl_mahasiswa = 'Cukup';
                } else {
                    $status_cpl_mahasiswa = 'Kurang';
                }
                array_push($data['status_nilai_cpl_mahasiswa'], $status_cpl_mahasiswa);
            }
        } else {
            foreach ($data['data_cpl'] as $cpl) {
                array_push($data['nilai_cpl_mahasiswa'], '-');
                array_push($data['status_nilai_cpl_mahasiswa'], '-');
            }
            $data['nama_rapor_mahasiswa'] = '-';
            $data['nim_rapor_mahasiswa'] = '-';
            $data['ttl_rapor_mahasiswa'] = '-';
            $data['tahun_masuk_rapor_mahasiswa'] = '-';
        }
		//dd($data);
        // Sub Menu Rapor Mata Kuliah
        // echo '<pre>';  var_dump($data['nilai_mk_raport']); echo '</pre>';
        // echo '<pre>';  var_dump($nilai_mahasiswa_tak_langsung); echo '</pre>';
        // echo '<pre>';  var_dump($data['nilai_mk_raport']); echo '</pre>';
        // echo '<pre>';  var_dump($mahasiswa); echo '</pre>';
        // echo '<pre>';  var_dump($mahasiswa[0]); echo '</pre>';
        
        return view('vw_template_dosen', $data);
    }

	public function periksa_kekurangan_cpmk_mahasiswa()
    {
        $data['breadcrumbs'] = 'report_mahasiswa';
        $data['content'] = 'reportdosen/vw_report_mahasiswa_periksa_kekurangan';

        $data['katkin'] = $this->katkinModel->getKatkin();
		$data['target_cpmk'] = $data['katkin'][0]->nilai_target_pencapaian_cpmk;


        if ($this->request->getPost('pilih')) {
            $nim = $this->request->getPost('nim');
        }

		$nilai_cpmk = $this->kinumumModel->getNilaiCpmkMahasiswa($nim);

		

		$data['nilai_dibawah_target'] = [];

		foreach ($nilai_cpmk as $key) {
			if ($key->nilai_langsung < $data['target_cpmk']) {
				$data_n = [
                "MataKuliah" => $key->nama_mata_kuliah,
                "CPMK" => $key->id_cpmk_langsung,
                "Nilai" => $key->nilai_langsung,
				];
				array_push($data['nilai_dibawah_target'], $data_n);
			}
			
		}

		if (empty($data['nilai_dibawah_target'])) {
			$nilai_kosong = [
				"MataKuliah" => "Semua Mata kuliah Melebihi Target",
                "CPMK" => " - ",
                "Nilai" => " - ",
			];
			array_push($data['nilai_dibawah_target'], $nilai_kosong);
		}

		//dd($nilai_cpmk,$data['katkin'],$nilai_dibawah_target);
        
        return view('vw_template_dosen', $data);
    }

	 public function kinerja_cpmk_mahasiswa()
    {
        $arr['breadcrumbs'] = 'report_kinerja_cpmk_mahasiswa';
        $arr['content'] = 'reportdosen/vw_report_kinerja_cpmk_mahasiswa';

        
        $arr['katkin'] = $this->katkinModel->getkatkin();
        $arr['data_cpl'] = $this->reportModel->getcpl();
        $arr['semester'] = $this->kincplModel->getsemester();
		$arr['data_mahasiswa'] = $this->mahasiswaModel->getMahasiswa();
        $nilai_cpmk = $this->kinumumModel->getnilaicpmk();
        $target = $this->katkinModel->getkatkin();
		$arr['status'] = "sembunyikan";

        $arr['cpmklang_a'] = [];
        $arr['cpmklang_b'] = [];
        $arr['cpmklang_c'] = [];
        $arr['mk_cpmk'] = [];
        $arr['nilai_cpmk'] = [];
        $arr['nilai_cpl_mahasiswa'] = [];
        $arr['status_nilai_cpl_mahasiswa'] = [];

        $arr['nim'] = 'F44190002';
        $tgl = date('Y');

        $th = 2017;
        $tahun_report = [];
        for ($i = $th; $i < $tgl; $i++) {
            array_push($tahun_report, $i);
        }

        

        if ($this->request->getPost('pilih')) {
            $nim = $this->request->getPost('nim');
            $arr['nim'] = $nim;
			$arr['status'] = "tampilkan";            
        }

		//dd($arr);

		$data_kurikulum_mahasiswa = $this->mahasiswaModel->getMahasiswaKurikulum($arr['nim']);
		$arr['kurikulum_mahasiswa'] = $data_kurikulum_mahasiswa[0]->kode_kurikulum;

	    $arr['mata_kuliah'] = $this->matakuliahModel->getMatakuliahKurikulum($arr['kurikulum_mahasiswa']);
        $kode_mk = [];
        foreach ($arr['mata_kuliah'] as $key) {
            array_push($kode_mk, $key->kode_mk);
        }

        foreach ($kode_mk as $key) {
            $mk_cpmk = $this->reportModel->getmkcpmk($key);

            $t_mk_cpmk = [];
            $t_n_cpmk = [];

            foreach ($mk_cpmk as $key) {
                array_push($t_mk_cpmk, $key->id_cpmk_langsung);

                $n_cpmk = $this->reportModel->getnilaicpmkselect($arr['nim']."_".$key->id_matakuliah_has_cpmk);
                if (empty($n_cpmk)) {
                    $n_cpmk = 0;
                }

                if ($n_cpmk == 0) {
                    array_push($t_n_cpmk, $n_cpmk);
                } else {
                    $nilai_sementara = [];
                    foreach ($n_cpmk as $key_2) {
                        array_push($nilai_sementara, $key_2->nilai_langsung);
                    }

                    $average = array_sum($nilai_sementara) / count($nilai_sementara);
                    array_push($t_n_cpmk, $average);
                }
            }

            array_push($arr['mk_cpmk'], $t_mk_cpmk);
            array_push($arr['nilai_cpmk'], $t_n_cpmk);
        }

		$arr['nama_mahasiswa'] = $this->reportModel->getNamaMahasiswa($arr['nim']);
        return view('vw_template_dosen', $arr);
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
        return $output;
    }
 
	public function mata_kuliah()
	{
		$data['breadcrumbs'] = 'report_mata_kuliah';
		$data['content'] = 'reportdosen/vw_report_mata_kuliah';

		$data['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
		$data['simpanan_mk'] = 'TIN211';
		$data['tahun_mk'] = 2018;
		$target = $this->katkinModel->getKatkin();
		$data['target_cpl'] = $target;
		$data['tahun_angkatan'] = $this->mahasiswaModel->getTahunMasuk();
		
		$data['status'] = "";
		$kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

		if ($this->request->getPost('pilih_4')) {
			$th = $this->request->getPost('tahun');
			$data['tahun_mk'] = $th;

			$mk_1 = $this->request->getPost('mk');
			$data['simpanan_mk'] = $mk_1;

			$data['status_aktif'] = '';
			$data['status_aktif_2'] = '';
			$data['status_aktif_4'] = 'show active';

			$data['naf'] = '';
			$data['naf_2'] = '';
			$data['naf_4'] = 'active';
			$data['status'] = "tampilkan";
		}

		$data['data_mk'] = $this->reportModel->getDataMk($data['simpanan_mk']);

		// dari Database
		$mahasiswa_2 = $this->kinumumModel->getMahasiswaTahun($data['tahun_mk']);
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

		$mk_raport = $this->reportModel->getMkCpmk($data['simpanan_mk']);
		$data['mk_raport'] = [];
		$data['nilai_mk_raport'] = [];
		$data['nilai_mk_raport_keseluruhan'] = [];
		$data['nilai_mk_raport_tl'] = [];
		$data['nilai_mk_raport_tak_langsung'] = [];
		$data['jumlah'] = [];

		foreach ($mk_raport as $key_0) {
			array_push($data['mk_raport'], $key_0->id_cpmk_langsung);
		}

		// Perhitungan CPMK Langsung
		foreach ($mk_raport as $key) {
			$nilai_mk_raport_s = [];
			$nilai_mk_raport_s_tl = [];
			foreach ($mahasiswa as $key_2) {
				$nilai_mahasiswa = $this->reportModel->getNilaiCpmk($key->id_matakuliah_has_cpmk, $key_2['Nim']);

				if (empty($nilai_mahasiswa)) {
					$nilai_mahasiswa = 0;
				}

				if ($nilai_mahasiswa == 0) {
					array_push($nilai_mk_raport_s, $nilai_mahasiswa);
				} else {
					$nilai_sementara = [];
					$nilai_sementara_tl = [];
					foreach ($nilai_mahasiswa as $key_2) {
						array_push($nilai_sementara, $key_2->nilai_langsung);
						array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
					}

					$average = array_sum($nilai_sementara) / count($nilai_sementara);
					$average_tl = array_sum($nilai_sementara_tl) / count($nilai_sementara_tl);
					array_push($nilai_mk_raport_s, $average);
					array_push($nilai_mk_raport_s_tl, $average_tl);
				}
			}

			$j = 0;
			foreach ($nilai_mk_raport_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$j_tl = 0;
			foreach ($nilai_mk_raport_s_tl as $k_tl) {
				if ($k_tl > 0.0) {
					$j_tl += 1;
				}
			}

			if ($j_tl == 0) {
				$j_tl = 1;
			}

			$dt_avg = array_sum($nilai_mk_raport_s) / $j;
			$dt_avg_tl = array_sum($nilai_mk_raport_s_tl) / $j_tl;

			array_push($data['nilai_mk_raport'], $dt_avg);
			array_push($data['nilai_mk_raport_keseluruhan'], $nilai_mk_raport_s);
			array_push($data['jumlah'], $j);
		}

		// Perhitungan CPMK tak langsung
		foreach ($mk_raport as $key) {
			$nilai_mk_raport_tak_langsung_s = [];
			foreach ($mahasiswa as $key_2) {
				$nilai_mahasiswa_tak_langsung = $this->reportModel->getNilaiCpmkTl($key->id_matakuliah_has_cpmk, $key_2['Nim']);

				if (empty($nilai_mahasiswa_tak_langsung)) {
					$nilai_mahasiswa_tak_langsung = 0;
				}

				if ($nilai_mahasiswa_tak_langsung == 0) {
					array_push($nilai_mk_raport_tak_langsung_s, $nilai_mahasiswa_tak_langsung);
				} else {
					$nilai_sementara_tl = [];
					foreach ($nilai_mahasiswa_tak_langsung as $key_2) {
						array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
					}

					$average_tl = array_sum($nilai_sementara_tl) / count($nilai_sementara_tl);
					array_push($nilai_mk_raport_tak_langsung_s, $average_tl);
				}
			}

			$j = 0;
			foreach ($nilai_mk_raport_tak_langsung_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$dt_avg = array_sum($nilai_mk_raport_tak_langsung_s) / $j;
			array_push($data['nilai_mk_raport_tak_langsung'], $dt_avg);
		}


		$data['data_nilai_epbm_mk'] = [];
		$data['data_nilai_epbm_dosen'] = [];
		$data['data_diagram_epbm_mk'] = [];
		$data['data_diagram_epbm_dosen'] = [];
		$data['kode_epbm_dosen'] = [];
		$data['nama_mata_kuliah'] = [];
		$data['nama_tahun'] = [];
		$data['nama_semester'] = [];
		$data['nama_dosen'] = [];
		$data['NIP_dosen'] = [];

		//echo '<pre>';  var_dump($data['data_epbm_mk_select']); echo '</pre>';

		//echo '<pre>';  var_dump($data['cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($data['nilai_diagram_cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa_2); echo '</pre>';
		//echo '<pre>';  var_dump($data['nilai_mk_raport_keseluruhan']); echo '</pre>';
		//echo '<pre>';  var_dump($data['tahun_mk']); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa_2); echo '</pre>';
		return view('vw_template_dosen', $data);
	}
 
 	public function download_report_mata_kuliah()
	{
		$data['breadcrumbs'] = 'report_mata_kuliah';
		$data['content'] = 'reportdosen/vw_report_mata_kuliah_print';

		$data['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
		$data['simpanan_mk'] = 'TIN211';
		$data['tahun_mk'] = 2018;
		$target = $this->katkinModel->getKatkin();
		$data['target_cpl'] = $target;

		if (!empty($this->request->getPost('download', true))) {
			$th = $this->request->getPost('tahun', true);
			$data['tahun_mk'] = $th;

			$mk_1 = $this->request->getPost('mk', true);
			$data['simpanan_mk'] = $mk_1;

			$data['status_aktif'] = '';
			$data['status_aktif_2'] = '';
			$data['status_aktif_4'] = 'show active';

			$data['naf'] = '';
			$data['naf_2'] = '';
			$data['naf_4'] = 'active';
		}

		$data['data_mk'] = $this->reportModel->getDataMk($data['simpanan_mk']);

		// dari Database
		$mahasiswa_2 = $this->kinumumModel->getMahasiswaTahun($data['tahun_mk']);
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

		$mk_raport = $this->reportModel->getMkCpmk($data['simpanan_mk']);
		$data['mk_raport'] = [];
		$data['nilai_mk_raport'] = [];
		$data['nilai_mk_raport_keseluruhan'] = [];
		$data['nilai_mk_raport_tl'] = [];
		$data['nilai_mk_raport_tak_langsung'] = [];
		$data['jumlah'] = [];

		foreach ($mk_raport as $key_0) {
			array_push($data['mk_raport'], $key_0->id_cpmk_langsung);
		}

		foreach ($mk_raport as $key) {
			$nilai_mk_raport_s = [];
			$nilai_mk_raport_s_tl = [];
			foreach ($mahasiswa as $key_2) {
				$nilai_mahasiswa = $this->reportModel->getNilaiCpmk($key->id_matakuliah_has_cpmk, $key_2['Nim']);

				if (empty($nilai_mahasiswa)) {
					$nilai_mahasiswa = 0;
				}

				if ($nilai_mahasiswa == 0) {
					array_push($nilai_mk_raport_s, $nilai_mahasiswa);
				} else {
					$nilai_sementara = [];
					$nilai_sementara_tl = [];
					foreach ($nilai_mahasiswa as $key_2) {
						array_push($nilai_sementara, $key_2->nilai_langsung);
						array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
					}

					$average = array_sum($nilai_sementara) / count($nilai_sementara);
					$average_tl = array_sum($nilai_sementara_tl) / count($nilai_sementara_tl);
					array_push($nilai_mk_raport_s, $average);
					array_push($nilai_mk_raport_s_tl, $average_tl);
				}
			}

			$j = 0;
			foreach ($nilai_mk_raport_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$j_tl = 0;
			foreach ($nilai_mk_raport_s_tl as $k_tl) {
				if ($k_tl > 0.0) {
					$j_tl += 1;
				}
			}

			if ($j_tl == 0) {
				$j_tl = 1;
			}

			$dt_avg = array_sum($nilai_mk_raport_s) / $j;
			$dt_avg_tl = array_sum($nilai_mk_raport_s_tl) / $j_tl;

			array_push($data['nilai_mk_raport'], $dt_avg);
			array_push($data['nilai_mk_raport_keseluruhan'], $nilai_mk_raport_s);
			array_push($data['jumlah'], $j);
		}

		foreach ($mk_raport as $key) {
			$nilai_mk_raport_tak_langsung_s = [];
			foreach ($mahasiswa as $key_2) {
				$nilai_mahasiswa_tak_langsung = $this->reportModel->getNilaiCpmkTl($key->id_matakuliah_has_cpmk, $key_2['Nim']);

				if (empty($nilai_mahasiswa_tak_langsung)) {
					$nilai_mahasiswa_tak_langsung = 0;
				}

				if ($nilai_mahasiswa_tak_langsung == 0) {
					array_push($nilai_mk_raport_tak_langsung_s, $nilai_mahasiswa_tak_langsung);
				} else {
					$nilai_sementara_tl = [];
					foreach ($nilai_mahasiswa_tak_langsung as $key_2) {
						array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
					}

					$average_tl = array_sum($nilai_sementara_tl) / count($nilai_sementara_tl);
					array_push($nilai_mk_raport_tak_langsung_s, $average_tl);
				}
			}

			$j = 0;
			foreach ($nilai_mk_raport_tak_langsung_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$dt_avg = array_sum($nilai_mk_raport_tak_langsung_s) / $j;
			array_push($data['nilai_mk_raport_tak_langsung'], $dt_avg);
		}

		// EPBM mata_kuliah
		$data['data_epbm_dosen'] = $this->reportModel->getEpbmMataKuliahHasDosen();
		$data['data_epbm_mk'] = $this->reportModel->getEpbmMataKuliah();
		$data['data_dosen'] = $this->reportModel->getDosen();
		$data['data_psd'] = $this->reportModel->getPsd();
		$data['psd'] = [];

		$data['data_epbm_mk_select'] = $this->reportModel->getEpbmMataKuliahHasDosenMkSelect($data['simpanan_mk']);
		$data['data_tahun'] = $this->reportModel->getTahun();
		$data['data_semester'] = ['Ganjil', 'Genap'];

		$data['data_nilai_epbm_mk'] = [];
		$data['data_nilai_epbm_dosen'] = [];
		$data['data_diagram_epbm_mk'] = [];
		$data['data_diagram_epbm_dosen'] = [];
		$data['kode_epbm_dosen'] = [];
		$data['nama_mata_kuliah'] = [];
		$data['nama_tahun'] = [];
		$data['nama_semester'] = [];
		$data['nama_dosen'] = [];
		$data['NIP_dosen'] = [];

		foreach ($data['data_semester'] as $key2) {
			foreach ($data['data_epbm_mk_select'] as $key) {
				$data_nilai_epbm_mk = $this->reportModel->getNilaiEpbmMk($data['tahun_mk'], $key2, $key->kode_epbm_mk);
				$data_nilai_epbm_dosen = $this->reportModel->getNilaiRaportEpbmDosen($data['tahun_mk'], $key2, $key->kode_epbm_mk_has_dosen);

				$data_diagram_epbm_mk = [];
				$data_diagram_epbm_dosen = [];
				$psd = [];

				if (!empty($data_nilai_epbm_dosen)) {
					for ($i = 1; $i < count($data_nilai_epbm_mk); $i++) {
						array_push($psd, $data['data_psd'][$i]->nama);
						array_push($data_diagram_epbm_mk, $data_nilai_epbm_mk[$i]->nilai);
						array_push($data_diagram_epbm_dosen, $data_nilai_epbm_dosen[$i]->nilai);
					}

					array_push($data['data_nilai_epbm_mk'], $data_nilai_epbm_mk);
					array_push($data['data_nilai_epbm_dosen'], $data_nilai_epbm_dosen);
					array_push($data['psd'], $psd);
					array_push($data['data_diagram_epbm_mk'], $data_diagram_epbm_mk);
					array_push($data['data_diagram_epbm_dosen'], $data_diagram_epbm_dosen);
					array_push($data['kode_epbm_dosen'], $key->kode_epbm_mk);
					array_push($data['nama_mata_kuliah'], $key->nama_mata_kuliah);
					array_push($data['nama_tahun'], $data['tahun_mk']);
					array_push($data['nama_semester'], $key2);
					array_push($data['nama_dosen'], $key->nama_dosen);
					array_push($data['NIP_dosen'], $key->NIP);
				}
			}
		}

		$data['title_print'] = "Report MataKuliah " . $data['data_mk'][0]->nama_mata_kuliah . " Angkatan " . $data['tahun_mk'];
		return view('vw_template_dosen_print', $data);
	}

	public function relevansi_ppm()
	{
		$data['breadcrumbs'] = 'report_relevansi_ppm';
		$data['content'] = 'reportdosen/vw_report_relevansi_ppm';

		$data['relevansi_ppm'] = $this->reportModel->getRelevansiPpm();
		$data['ppm'] = $this->reportModel->getPpm();
		$data['cpl'] = $this->reportModel->getCpl();
		$data['nilai_ppm'] = [];
		$data['nilai_cpl'] = [];
		$data['nilai_diagram_ppm'] = [];
		$data['nilai_diagram_cpl'] = [];
		$data['nama_cpl'] = [];
		$data['nama_ppm'] = [];

		foreach ($data['cpl'] as $key) {
			$nilai_ppm_cpl = [];
			foreach ($data['relevansi_ppm'] as $key2) {
				$nilai = $this->reportModel->getNilaiPpmCpl($key->id_cpl_langsung, $key2->id_relevansi_ppm);
				$n = intval($nilai['0']->nilai_relevansi_ppm_cpl);
				array_push($nilai_ppm_cpl, $n);
			}
			$average_nilai_ppm_cpl = array_sum($nilai_ppm_cpl) / count($nilai_ppm_cpl);
			array_push($data['nilai_cpl'], $nilai_ppm_cpl);
			array_push($data['nama_cpl'], $key->nama);
		}

		foreach ($data['ppm'] as $key) {
			$nilai_ppm = [];
			foreach ($data['relevansi_ppm'] as $key2) {
				$nilai = $this->reportModel->getNilaiPpm($key->id, $key2->id_relevansi_ppm);
				$n = intval($nilai['0']->nilai_relevansi_ppm);
				array_push($nilai_ppm, $n);
			}
			$average_nilai_ppm = array_sum($nilai_ppm) / count($nilai_ppm);
			array_push($data['nilai_ppm'], $nilai_ppm);
			array_push($data['nama_ppm'], $key->nama);
		}

		for ($i = 1; $i < 6; $i++) {
			$nilai_diagram = [];
			for ($j = 0; $j < count($data['cpl']); $j++) {
				$n = 0;
				foreach ($data['nilai_cpl'][$j] as $key) {
					if ($key == $i) {
						$n += 1;
					}
				}
				$m = round($n / count($data['nilai_cpl'][$j]) * 100);
				array_push($nilai_diagram, $m);
			}
			array_push($data['nilai_diagram_cpl'], $nilai_diagram);
		}

		for ($i = 1; $i < 6; $i++) {
			$nilai_diagram = [];
			for ($j = 0; $j < count($data['ppm']); $j++) {
				$n = 0;
				foreach ($data['nilai_ppm'][$j] as $key) {
					if ($key == $i) {
						$n += 1;
					}
				}
				$m = round($n / count($data['nilai_ppm'][$j]) * 100);
				array_push($nilai_diagram, $m);
			}
			array_push($data['nilai_diagram_ppm'], $nilai_diagram);
		}

		return view('vw_template_dosen', $data);
	}


	public function efektivitas_cpl()
	{
		$data['breadcrumbs'] = 'report_efektivitas_cpl';
		$data['content'] = 'reportdosen/vw_report_efektivitas_cpl';

		$data['mahasiswa'] = $this->reportModel->getMahasiswa();
		$data['cpl'] = $this->reportModel->getCpl();
		$data['nilai_cpl'] = [];
		$data['nilai_cpl_keseluruhan'] = [];
		$data['jumlah'] = [];
		$data['nilai_diagram'] = [];
		$data['nama_cpl'] = [];

		foreach ($data['cpl'] as $key) {
			$nilai_efektivitas_cpl = [];
			foreach ($data['mahasiswa'] as $key2) {
				$nilai = $this->reportModel->getNilaiEfektivitasCpl($key->id_cpl_langsung, $key2->nim);
				$n = empty($nilai) ? 0 : intval($nilai['0']->nilai);
				array_push($nilai_efektivitas_cpl, $n);
			}

			$j = 0;
			foreach ($nilai_efektivitas_cpl as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$average_nilai_cpl = array_sum($nilai_efektivitas_cpl) / $j;
			array_push($data['nilai_cpl'], round($average_nilai_cpl));
			array_push($data['jumlah'], $j);
			array_push($data['nilai_cpl_keseluruhan'], $nilai_efektivitas_cpl);
			array_push($data['nama_cpl'], $key->nama);
		}

		for ($i = 1; $i < 8; $i++) {
			$nilai_diagram = [];
			for ($j = 0; $j < count($data['cpl']); $j++) {
				$n = 0;
				foreach ($data['nilai_cpl_keseluruhan'][$j] as $key) {
					if ($key == $i) {
						$n += 1;
					}
				}
				$m = round($n / $data['jumlah'][$j] * 100);
				array_push($nilai_diagram, $m);
			}
			array_push($data['nilai_diagram'], $nilai_diagram);
		}

		return view('vw_template_dosen', $data);
	}


	public function report_epbm_copy()
	{
		$data['breadcrumbs'] = 'report';
		$data['content'] = 'reportdosen/vw_report_epbm';

		$data['data_epbm_dosen'] = $this->reportModel->getEpbmMataKuliahHasDosen();
		$data['data_epbm_mk'] = $this->reportModel->getEpbmMataKuliah();
		$data['data_dosen'] = $this->reportModel->getDosen();
		$data['data_psd'] = $this->reportModel->getPsd();
		$data['psd'] = [];

		$data['tahun'] = '2015';
		$data['semester'] = 'Ganjil';
		$data['dosen'] = '196106301986032003';
		$data['mk'] = 'TIN213 / 1';

		if ($this->request->getPost('pilih')) {
			$data['tahun'] = $this->request->getPost('tahun');
			$data['semester'] = $this->request->getPost('semester');
			$data['dosen'] = $this->request->getPost('dosen');
			$data['mk'] = $this->request->getPost('mk');
		}

		$data['data_nilai_epbm_mk'] = $this->reportModel->getNilaiEpbmMk($data['tahun'], $data['semester'], $data['mk']);
		$data['data_nilai_epbm_dosen'] = $this->reportModel->getNilaiEpbmDosen($data['tahun'], $data['semester'], $data['mk'] . "_" . $data['dosen']);

		$data['data_diagram_epbm_mk'] = [];
		$data['data_diagram_epbm_dosen'] = [];

		for ($i = 1; $i < count($data['data_nilai_epbm_mk']); $i++) {
			array_push($data['psd'], $data['data_psd'][$i]->nama);
			array_push($data['data_diagram_epbm_mk'], $data['data_nilai_epbm_mk'][$i]->nilai);
			array_push($data['data_diagram_epbm_dosen'], $data['data_nilai_epbm_dosen'][$i]->nilai);
		}

		return view('vw_template_dosen', $data);
	}


	public function report_epbm()
	{
		$data['breadcrumbs'] = 'report_epbm';
		$data['content'] = 'reportdosen/vw_report_epbm_2';

		$data['data_epbm_dosen'] = $this->reportModel->getEpbmMataKuliahHasDosen();
		$data['data_epbm_mk'] = $this->reportModel->getEpbmMataKuliah();
		$data['data_dosen'] = $this->reportModel->getDosen();
		$data['data_psd'] = $this->reportModel->getPsd();
		$data['psd'] = [];

		$data['tahun'] = '2015';
		$data['semester'] = 'Ganjil';
		$data['dosen'] = '196106301986032003';

		if ($this->request->getPost('pilih')) {
			$data['dosen'] = $this->request->getPost('dosen');
		}

		$data['data_epbm_dosen_select'] = $this->reportModel->getEpbmMataKuliahHasDosenSelect($data['dosen']);
		$data['data_tahun'] = $this->reportModel->getTahun();
		$data['data_semester'] = ['Ganjil', 'Genap'];

		$data['data_nilai_epbm_mk'] = [];
		$data['data_nilai_epbm_dosen'] = [];
		$data['data_diagram_epbm_mk'] = [];
		$data['data_diagram_epbm_dosen'] = [];
		$data['kode_epbm_dosen'] = [];
		$data['nama_mata_kuliah'] = [];
		$data['nama_tahun'] = [];
		$data['nama_semester'] = [];

		foreach ($data['data_tahun'] as $key1) {
			foreach ($data['data_semester'] as $key2) {
				foreach ($data['data_epbm_dosen_select'] as $key) {
					$data_nilai_epbm_mk = $this->reportModel->getNilaiEpbmMk($key1->tahun, $key2, $key->kode_epbm_mk);
					$data_nilai_epbm_dosen = $this->reportModel->getNilaiEpbmDosen($key1->tahun, $key2, $key->kode_epbm_mk . "_" . $data['dosen']);

					$data_diagram_epbm_mk = [];
					$data_diagram_epbm_dosen = [];
					$psd = [];

					if (!empty($data_nilai_epbm_dosen)) {
						for ($i = 1; $i < count($data_nilai_epbm_mk); $i++) {
							array_push($psd, $data['data_psd'][$i]->nama);
							array_push($data_diagram_epbm_mk, $data_nilai_epbm_mk[$i]->nilai);
							array_push($data_diagram_epbm_dosen, $data_nilai_epbm_dosen[$i]->nilai);
						}

						array_push($data['data_nilai_epbm_mk'], $data_nilai_epbm_mk);
						array_push($data['data_nilai_epbm_dosen'], $data_nilai_epbm_dosen);
						array_push($data['psd'], $psd);
						array_push($data['data_diagram_epbm_mk'], $data_diagram_epbm_mk);
						array_push($data['data_diagram_epbm_dosen'], $data_diagram_epbm_dosen);
						array_push($data['kode_epbm_dosen'], $key->kode_epbm_mk);
						array_push($data['nama_mata_kuliah'], $key->nama_mata_kuliah);
						array_push($data['nama_tahun'], $key1->tahun);
						array_push($data['nama_semester'], $key2);
					}
				}
			}
		}

		return view('vw_template_dosen', $data);
	}

} 
 