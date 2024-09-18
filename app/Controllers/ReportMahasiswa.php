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

class ReportMahasiswa extends BaseController
{
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $kincpmkModel;
    protected $reportModel;
    protected $katkinModel;
    protected $kinumumModel;
    protected $kincplModel;
    protected $epbmModel;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        
        if (!$this->session->get('loggedin') || $this->session->get('level') != 2) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }

        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kincpmkModel = new KincpmkModel();
        $this->reportModel = new ReportModel();
        $this->katkinModel = new KatkinModel();
        $this->kinumumModel = new KinumumModel();
        $this->kincplModel = new KincplModel();
        $this->epbmModel = new EpbmModel();
    }
 
	public function index()
{
    $data = [
        'breadcrumbs' => 'report',
        'content' => 'login_mahasiswa/vw_report',
        'status_aktif' => 'show active',
        'status_aktif_2' => '',
        'status_aktif_3' => '',
        'status_aktif_4' => '',
        'naf' => 'active',
        'naf_2' => '',
        'naf_3' => '',
        'naf_4' => '',
        'mata_kuliah' => $this->matakuliahModel->getMatakuliah(),
        'katkin' => $this->katkinModel->getKatkin(),
        'semester' => $this->kincplModel->getSemester(),
        'nim_3' => session()->get('nama_user'),
        'cpl' => $this->kincplModel->getCpl(),
    ];

    
    //dd($data);
    $data['simpanan_cpl'] = ($data['cpl'][7]->id_cpl_langsung);

    $data['nim'] = session()->get('nama_user');
    $data_kurikulum_mahasiswa = $this->mahasiswaModel->getMahasiswaKurikulum($data['nim']);
	$data['kurikulum_mahasiswa'] = $data_kurikulum_mahasiswa[0]->kode_kurikulum;

    $data['data_cpl'] = $this->kinumumModel->getCpl($data['kurikulum_mahasiswa']);
    $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor($data['kurikulum_mahasiswa']);
    $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk($data['kurikulum_mahasiswa']);
    $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();
    $target = $this->katkinModel->getKatkin();
    $target_cpl = ($target[0]->nilai_target_pencapaian_cpl);

    if ($this->request->getPost('pilih_3')) {
        $cpl_1 = $this->request->getPost('cpl', FILTER_SANITIZE_STRING);
        $data['simpanan_cpl'] = $cpl_1;
        $data['status_aktif'] = '';
        $data['status_aktif_2'] = '';
        $data['status_aktif_3'] = 'show active';
        $data['naf'] = '';
        $data['naf_2'] = '';
        $data['naf_3'] = 'active';
    }

    $nim_3 = $data['nim_3'];
    $nilai_target = [];
    $persentase_nilai_target = [];

    foreach ($data['semester'] as $semester) {
        $n_target = 0;
        foreach ($rumus_cpl as $rcpl) {
            if ($data['simpanan_cpl'] == $rcpl->id_cpl_langsung) {
                foreach ($rumus_deskriptor as $rdesc) {
                    if ($rcpl->id_cpl_rumus_deskriptor == $rdesc->id_deskriptor && $semester->id_semester == $rdesc->id_semester) {
                        $n_target += $rcpl->persentasi * $target_cpl * $rdesc->persentasi;
                    }
                }
            }
        }
        $nilai_target[] = $n_target; 
    }

    for ($i = 0; $i < count($nilai_target); $i++) {
        $pnt = 0;
        for ($p = 0; $p <= $i; $p++) {
            $pnt += $nilai_target[$p];
        }
        $persentase_nilai_target[] = $pnt;
    }

    $nilai_maksimal = [];
    $persentase_nilai_maksimal = [];

    foreach ($data['semester'] as $semester) {
        $n_m = 0;
        foreach ($rumus_cpl as $rcpl) {
            if ($data['simpanan_cpl'] == $rcpl->id_cpl_langsung) {
                foreach ($rumus_deskriptor as $rdesc) {
                    if ($rcpl->id_cpl_rumus_deskriptor == $rdesc->id_deskriptor && $semester->id_semester == $rdesc->id_semester) {
                        $n_m += $rcpl->persentasi * 100 * $rdesc->persentasi;
                    }
                }
            }
        }
        $nilai_maksimal[] = $n_m;
    }

    for ($i = 0; $i < count($nilai_maksimal); $i++) {
        $pnt = 0;
        for ($p = 0; $p <= $i; $p++) {
            $pnt += $nilai_maksimal[$p];
        }
        $persentase_nilai_maksimal[] = $pnt;
    }

    $nilai_cpl_average = [];
    $nilai_capaian_mahasiswa = [];

    foreach ($data['semester'] as $semester) {
        $n = 0;
        foreach ($nilai_cpmk as $cpmk) {
            if ($data['nim_3'] == $cpmk->nim) {
                $n_1 = 0;
                foreach ($rumus_cpl as $rcpl) {
                    if ($data['simpanan_cpl'] == $rcpl->id_cpl_langsung) {
                        foreach ($rumus_deskriptor as $rdesc) {
                            if ($rcpl->id_cpl_rumus_deskriptor == $rdesc->id_deskriptor && $semester->id_semester == $rdesc->id_semester && $cpmk->id_matakuliah_has_cpmk == $rdesc->id_matakuliah_has_cpmk) {
                                $n_1 += $rcpl->persentasi * $cpmk->nilai_langsung * $rdesc->persentasi;
                            }
                        }
                    }
                }
                $n += $n_1;
            }
        }
        $nilai_cpl_average[] = $n;
    }

    for ($i = 0; $i < count($nilai_cpl_average); $i++) {
        $pnt = 0;
        for ($p = 0; $p <= $i; $p++) {
            $pnt += $nilai_cpl_average[$p];
        }
        $nilai_capaian_mahasiswa[] = $pnt;
    }

    $data['capaian'] = $nilai_capaian_mahasiswa;
    $data['target'] = $persentase_nilai_target;
    $data['nilai_tertinggi'] = $persentase_nilai_maksimal;
    $data['nama_semester'] = [];
    foreach ($data['semester'] as $semester) {
        $data['nama_semester'][] = "Semester " . $semester->nama;
    }

    $kode_mk = [];
    foreach ($data['mata_kuliah'] as $mk) {
        $kode_mk[] = $mk->kode_mk;
    }

    $data['cpmklang_a'] = [];
    $data['cpmklang_b'] = [];
    $data['cpmklang_c'] = [];
    $data['mk_cpmk'] = [];
    $data['nilai_cpmk'] = [];
    $data['nilai_cpl_mahasiswa'] = [];
    $data['status_nilai_cpl_mahasiswa'] = [];

    
    $tgl = date('Y');
    $th = 2017;
    $tahun_report = [];


    $n_m = $this->mahasiswaModel->getMahasiswaInfo($data['nim']);
    //dd($n_m);
    $data['nama'] = ($n_m[0]->nama);
    $data['ns'] = 'Nilai CPMK ' . $data['nama'] . ' (' . $data['nim'] . ')';

	//mendefinisikan matakuliah dan nilai cpmk
	foreach ($kode_mk as $kode) {
        $mk_cpmk = $this->reportModel->getMkCpmk($kode);
        $t_mk_cpmk = [];
        $t_n_cpmk = [];

        foreach ($mk_cpmk as $cpmk) {
            $t_mk_cpmk[] = $cpmk->id_cpmk_langsung;
            $n_cpmk = $this->reportModel->getNilaiCpmk($cpmk->id_matakuliah_has_cpmk, $data['nim']);

            if (empty($n_cpmk)) {
                $n_cpmk = 0;
            }

            if ($n_cpmk == 0) {
                $t_n_cpmk[] = $n_cpmk;
            } else {
                $nilai_sementara = [];
                foreach ($n_cpmk as $ncpmk) {
                    $nilai_sementara[] = $ncpmk->nilai_langsung;
                }

                $average = array_sum($nilai_sementara) / count($nilai_sementara);
                $t_n_cpmk[] = $average;
            }
        }
        $data['mk_cpmk'][] = $t_mk_cpmk;
        $data['nilai_cpmk'][] = $t_n_cpmk;
    }
 




    //- Sub Menu Rapor Mahasiswa- -

		$rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor($data['kurikulum_mahasiswa']);
		$rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk($data['kurikulum_mahasiswa']);
		$nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

		$nim_2 = session()->get('nama_user');
		$data['nim_2'] = $nim_2;
        //dd($dt_mahasiswa,$nim_2);
        $n_m = $this->mahasiswaModel->getMahasiswaInfo($nim_2);

		$data['nama_rapor_mahasiswa'] = $n_m[0]->nama;
		$data['nim_rapor_mahasiswa'] = $n_m[0]->nim;

		$batas_cukup = $data['katkin'][0]->batas_bawah_kategori_cukup_cpl;
		$batas_baik = $data['katkin'][0]->batas_bawah_kategori_baik_cpl;
		$batas_sangat_baik = $data['katkin'][0]->batas_bawah_kategori_sangat_baik_cpl;

		$data['nilai_cpl_mahasiswa'] = [];
		$data['status_nilai_cpl_mahasiswa'] = [];

		foreach ($data['data_cpl'] as $key_0) {
			$n = 0;
			foreach ($nilai_cpmk as $key_2) {
				if ($data['nim_rapor_mahasiswa'] == $key_2->nim) {
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
			array_push($data['nilai_cpl_mahasiswa'], $n);
		}

		foreach ($data['nilai_cpl_mahasiswa'] as $key) {
			if ($key > $batas_sangat_baik) {
				$status_cpl_mahasiswa = 'Sangat Baik';
			} elseif ($key > $batas_baik) {
				$status_cpl_mahasiswa = 'Baik';
			} elseif ($key > $batas_cukup) {
				$status_cpl_mahasiswa = 'Cukup';
			} else {
				$status_cpl_mahasiswa = 'Kurang';
			}

			array_push($data['status_nilai_cpl_mahasiswa'], $status_cpl_mahasiswa);
		}
	
        return view('vw_template_mahasiswa', $data);
	}

	public function download_report_mahasiswa()
    {
        $data = [];
        $data['breadcrumbs'] = 'report';
        $data['content'] = 'report/vw_report_mahasiswa_print';
        
        $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor();
        $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk();
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

        $data['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
        $data['katkin'] = $this->katkinModel->getKatkin();
        $data['data_cpl'] = $this->reportModel->getCpl();
        $data['nilai_cpl_mahasiswa'] = [];
        $data['status_nilai_cpl_mahasiswa'] = [];
        
        $currentYear = date('Y');
        $startYear = 2017;
        $tahun_report = range($startYear, $currentYear - 1);

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

        $dt_mahasiswa_2 = [];
        foreach ($tahun_report as $key) {
            $send = curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=" . $key);
            $dt_mahasisw = json_decode($send, true);
            $dt_mahasiswa_2[] = $dt_mahasisw;
        }

        $dt_mahasiswa = array_reduce($dt_mahasiswa_2, 'array_merge', []);
       // dd($dt_mahasiswa);
        if ($this->request->getPost('download')) {
            $nim_2 = session()->get('nama_user');
            $data['nim_2'] = $nim_2;

            //dd($dt_mahasiswa,$nim_2,$tahun_report);
            foreach ($dt_mahasiswa as $key) {
                if ($key["Nim"] == $nim_2) {
                    $n_m = $key;
                }
            }

            $data['nama_rapor_mahasiswa'] = $n_m["Nama"];
            $data['nim_rapor_mahasiswa'] = $n_m["Nim"];

            $batas_cukup = $data['katkin'][0]->batas_bawah_kategori_cukup_cpl;
            $batas_baik = $data['katkin'][0]->batas_bawah_kategori_baik_cpl;
            $batas_sangat_baik = $data['katkin'][0]->batas_bawah_kategori_sangat_baik_cpl;

            $data['nilai_cpl_mahasiswa'] = [];
            $data['status_nilai_cpl_mahasiswa'] = [];

            foreach ($data['data_cpl'] as $key_0) {
                $n = 0;
                foreach ($nilai_cpmk as $key_2) {
                    if ($data['nim_rapor_mahasiswa'] == $key_2->nim) {
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
                array_push($data['nilai_cpl_mahasiswa'], $n);
            }

            foreach ($data['nilai_cpl_mahasiswa'] as $key) {
                if ($key > $batas_sangat_baik) {
                    $status_cpl_mahasiswa = 'Sangat Baik';
                } elseif ($key > $batas_baik) {
                    $status_cpl_mahasiswa = 'Baik';
                } elseif ($key > $batas_cukup) {
                    $status_cpl_mahasiswa = 'Cukup';
                } else {
                    $status_cpl_mahasiswa = 'Kurang';
                }

                array_push($data['status_nilai_cpl_mahasiswa'], $status_cpl_mahasiswa);
            }
        } else {
            foreach ($data['data_cpl'] as $key) {
                $data['nilai_cpl_mahasiswa'][] = '-';
                $data['status_nilai_cpl_mahasiswa'][] = '-';
            }
            $data['nama_rapor_mahasiswa'] = '-';
            $data['nim_rapor_mahasiswa'] = '-';
        }

        $data['title_print'] = "Report Mahasiswa " . $data['nama_rapor_mahasiswa'] . "-" . $data['nim_rapor_mahasiswa'];

        return view('vw_template_print', $data);
    }
 
		
} 
 