<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Models\DosenModel;
use App\Models\MatakuliahModel;
use App\Models\PerbaikanModel;
use App\Models\MahasiswaModel;
use App\Models\KincpmkModel;
use App\Models\ReportModel;
use App\Models\KatkinModel;
use App\Models\KinumumModel;
use App\Models\KincplModel;
use App\Models\EpbmModel;
use CodeIgniter\Controller;

class PerbaikanMatakuliah extends BaseController {

    protected $dosenModel;
    protected $matakuliahModel;
    protected $perbaikanModel;
    protected $mahasiswaModel;
    protected $kincpmkModel;
    protected $reportModel;
    protected $katkinModel;
    protected $kinumumModel;
    protected $kincplModel;
    protected $epbmModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->perbaikanModel = new PerbaikanModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kincpmkModel = new KincpmkModel();
        $this->reportModel = new ReportModel();
        $this->katkinModel = new KatkinModel();
        $this->kinumumModel = new KinumumModel();
        $this->kincplModel = new KincplModel();
        $this->epbmModel = new EpbmModel();
        $this->session = \Config\Services::session();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'perbaikan';
        $data['content'] = 'vw_perbaikan_matakuliah';
        $data['datas'] = $this->perbaikanModel->getPerbaikanMataKuliah();

        return view('vw_template', $data);
    }

    public function tambah()
    {
        $data['breadcrumbs'] = 'dosen';
        $data['content'] = 'perbaikan_matakuliah/tambah';
        $data['dosen'] = $this->dosenModel->getDosen();
        $data['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
		//dd($data['dosen']);

        return view('vw_template', $data);
    }

    public function submit_tambah()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'id' => $this->request->getPost('dosen') . "_" . $this->request->getPost('mata_kuliah') . "_" . $this->request->getPost('tahun'),
                'NIP' => $this->request->getPost('dosen'),
                'kode_mk' => $this->request->getPost('mata_kuliah'),
                'tahun' => $this->request->getPost('tahun'),
                'analisis' => $this->request->getPost('analisis'),
                'perbaikan' => $this->request->getPost('perbaikan'),
            ];

            if ($this->perbaikanModel->submitTambah($save_data)) {
                return redirect()->to('/perbaikanmatakuliah');
            }
        }
    }

    public function submit_edit()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'analisis' => $this->request->getPost('analisis'),
                'perbaikan' => $this->request->getPost('perbaikan'),
            ];
            $id_edit = $this->request->getPost('id');

            if ($this->perbaikanModel->submitEdit($save_data, $id_edit)) {
                return redirect()->to('/perbaikanmatakuliah');
            }
        }
    }

    public function edit($id)
    {
        $edit = $this->perbaikanModel->editPerbaikanMataKuliah($id);
        $data = [
            'data' => $edit,
            'breadcrumbs' => 'perbaikan_matakuliah',
            'content' => 'perbaikan_matakuliah/edit'
        ];

        return view('vw_template', $data);
    }


	public function download($id)
	{
		$edit = $this->perbaikanModel->editPerbaikanMataKuliah($id);
		$arr = [];
		foreach ($edit as $row) {
			$arr['data'] = $row;
		}
		$arr['breadcrumbs'] = 'perbaikan_matakuliah';
		$arr['content'] = 'perbaikan_matakuliah/vw_perbaikan_matakuliah_print';

		$arr['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
		$arr['target_cpl'] = $this->katkinModel->getKatkin();
		$arr['simpanan_mk'] = $arr['data']->kode_mk;
		$arr['tahun_mk'] = $arr['data']->tahun;
		$arr['data_mk'] = $this->reportModel->getDataMk($arr['simpanan_mk']);

		// dari Database
		$mahasiswa_2 = $this->kinumumModel->getMahasiswaTahun($arr['tahun_mk']);
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

		$mk_raport = $this->reportModel->getMkCpmk($arr['simpanan_mk']);
		$arr['mk_raport'] = [];
		$arr['nilai_mk_raport'] = [];
		$arr['nilai_mk_raport_keseluruhan'] = [];
		$arr['nilai_mk_raport_tl'] = [];
		$arr['nilai_mk_raport_tak_langsung'] = [];
		$arr['jumlah'] = [];

		foreach ($mk_raport as $key_0) {
			array_push($arr['mk_raport'], $key_0->id_cpmk_langsung);
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

			array_push($arr['nilai_mk_raport'], $dt_avg);
			array_push($arr['nilai_mk_raport_keseluruhan'], $nilai_mk_raport_s);
			array_push($arr['jumlah'], $j);
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
			array_push($arr['nilai_mk_raport_tak_langsung'], $dt_avg);
		}

		$arr['title_print'] = "Perbaikan MataKuliah " . $arr['data_mk'][0]->nama_mata_kuliah . " Angkatan " . $arr['tahun_mk'];
		return view('vw_template_print', $arr);
	}

   public function hapus($id)
    {
        if ($this->perbaikanModel->hapus($id)) {
            return redirect()->to('/perbaikanmatakuliah');
        }
    }

    public function export_excel()
    {
        $data_dosen = $this->perbaikanModel->getDosen();
        $data = [
            'title' => 'Data dosen',
            'data' => $data_dosen
        ];

        return view('vw_excel_dosen', $data);
    }
   
 
}

 


 