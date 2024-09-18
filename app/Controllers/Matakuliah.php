<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\KurikulumModel;
use App\Models\KurikulumTerpilihModel;
use CodeIgniter\Controller;

class Matakuliah extends BaseController
{
    protected $matakuliahModel;
    protected $kurikulumModel;
    protected $kurikulumTerpilihModel;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->kurikulumModel = new KurikulumModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();
        $this->session = \Config\Services::session();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data['breadcrumbs'] = 'matakuliah';
        $data['content'] = 'vw_matakuliah';
        $data['data_semester'] = $this->matakuliahModel->getSemester();

        $data['kurikulum'] = $this->kurikulumModel->get("asc");
        $kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

        $data['datas'] = $this->matakuliahModel->getMatakuliah();
        $data['datas'] = $this->matakuliahModel->getMatakuliahKurikulum($data['kurikulum_terpilih']);

        echo view('vw_template', $data);
    }

    public function generateRandomString($length = 10)
    {
        return bin2hex(random_bytes($length / 2));
    }

    public function submit_tambah()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'kode_mk' => $this->request->getPost('kode_mata_kuliah', FILTER_SANITIZE_STRING),
                'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah', FILTER_SANITIZE_STRING),
                'sks' => $this->request->getPost('sks', FILTER_SANITIZE_STRING),
                'kode_kurikulum' => $this->request->getPost('kode_kurikulum', FILTER_SANITIZE_STRING),
                'id_semester' => 1,
            ];


            $query = $this->matakuliahModel->submitTambah($save_data);

            $cpmk = $this->matakuliahModel->getCpmk();

            for ($i=0; $i < 3; $i++) { 
                $save_data_cpmk = [
                    'id_matakuliah_has_cpmk' => str_replace(' ', '', $this->request->getPost('kode_mata_kuliah', FILTER_SANITIZE_STRING)) . '_' . $cpmk[$i]->id_cpmk_langsung,
                    'id_cpmk_langsung' => $cpmk[$i]->id_cpmk_langsung,
                    'kode_mk' => str_replace(' ', '', $this->request->getPost('kode_mata_kuliah', FILTER_SANITIZE_STRING)),
                ];
                $this->matakuliahModel->submitTambahMatakuliahHasCpmk($save_data_cpmk);
            }

            if ($query) {
                session()->setFlashdata('success', 'Data berhasil disimpan!');
                return redirect()->to('/matakuliah');
            }
        }
    }

    private function uploadRps($fileName)
    {
        $file = $this->request->getFile('rps');
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move('./uploads', $fileName);
        }
    }

    public function submit_edit()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah', FILTER_SANITIZE_STRING),
                'sks' => $this->request->getPost('sks', FILTER_SANITIZE_STRING),
            ];
            $id_edit = $this->request->getPost('kode_mata_kuliah', FILTER_SANITIZE_STRING);

            $query = $this->matakuliahModel->submitEdit($save_data, $id_edit);
            if ($query) {
                session()->setFlashdata('success', 'Data berhasil diubah!');
                return redirect()->to('/matakuliah');
            }
        }
    }

    public function detail()
    {
        $data['breadcrumbs'] = 'matakuliah';
        $data['content'] = 'vw_matakuliah_detail';

        echo view('vw_template', $data);
    }

    public function edit($id)
    {
        $edit = $this->matakuliahModel->editMatakuliah($id);
        $data['data'] = $edit;
        $data['cpmk'] = $this->matakuliahModel->getMatakuliahHasCpmkByMk($id);
        $data['breadcrumbs'] = 'matakuliah';
        $data['content'] = 'matakuliah/edit';
		//dd($data);

        echo view('vw_template', $data);
    }

    public function cetak_edit($id)
    {
        $edit = $this->matakuliahModel->editMatakuliah($id);
        $data['data'] = $edit;
        $data['cpmk'] = $this->matakuliahModel->getMatakuliahHasCpmkByMk($id);
        $data['breadcrumbs'] = 'matakuliah';
        $data['content'] = 'matakuliah/cetak_edit';

        echo view('matakuliah/cetak_edit', $data);
    }

    public function edit_matakuliah_has_cpmk($id)
    {
        $edit = $this->matakuliahModel->editMatakuliahHasCpmk($id);
        $data['data'] = $edit;
        $data['data_cpmk'] = $this->matakuliahModel->getCpmk();
        $data['breadcrumbs'] = 'matakuliah';
        $data['content'] = 'matakuliah/edit_matakuliah_has_cpmk';

        echo view('vw_template', $data);
    }

    public function hapus($id)
    {
        $delete = $this->matakuliahModel->hapus($id);
        if ($delete) {
            session()->setFlashdata('success', 'Matakuliah'.$id.' berhasil dihapus!');
            return redirect()->to('/matakuliah');
        }
    }

    public function lihat_rps($id)
    {
        $arr = $this->matakuliahModel->getRps($id);
        return $this->response->download('./uploads/' . $arr['rps'], null);
    }

    public function tambah_matakuliah_has_cpmk($id)
    {
        $edit = $this->matakuliahModel->editMatakuliah($id);
        $data['data'] = $edit;
        $data['data_cpmk'] = $this->matakuliahModel->getCpmk();
        $data['breadcrumbs'] = 'Matakuliah';
        $data['content'] = 'Matakuliah/tambah_matakuliah_has_cpmk';

        echo view('vw_template', $data);
    }

    public function submit_tambah_matakuliah_has_cpmk()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'id_matakuliah_has_cpmk' => $this->request->getPost('mk', FILTER_SANITIZE_STRING) . '_' . $this->request->getPost('cpmk', FILTER_SANITIZE_STRING),
                'id_cpmk_langsung' => $this->request->getPost('cpmk', FILTER_SANITIZE_STRING),
                'kode_mk' => $this->request->getPost('mk', FILTER_SANITIZE_STRING),
                'deskripsi_matakuliah_has_cpmk' => $this->request->getPost('deskripsi', FILTER_SANITIZE_STRING),
            ];
            $kode_mk = $this->request->getPost('mk', FILTER_SANITIZE_STRING);

            $query = $this->matakuliahModel->submitTambahMatakuliahHasCpmk($save_data);
            if ($query) {
                return redirect()->to('/matakuliah/edit/' . $kode_mk);
            }
        }
    }

    public function submit_edit_matakuliah_has_cpmk()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'id_cpmk_langsung' => $this->request->getPost('cpmk', FILTER_SANITIZE_STRING),
                'deskripsi_matakuliah_has_cpmk' => $this->request->getPost('deskripsi', FILTER_SANITIZE_STRING),
            ];
            $kode_mk = $this->request->getPost('mk', FILTER_SANITIZE_STRING);
            $id_edit = $this->request->getPost('id_matakuliah_has_cpmk', FILTER_SANITIZE_STRING);

            $query = $this->matakuliahModel->submitEditMatakuliahHasCpmk($save_data, $id_edit);
            if ($query) {
                return redirect()->to('/matakuliah/edit/' . $kode_mk);
            }
        }
    }

    public function hapus_matakuliah_has_cpmk($id)
    {
        $kode_mk = $this->matakuliahModel->getMkMatakuliahHasCpmk($id);
        $k = $kode_mk[0]->kode_mk;

        $delete = $this->matakuliahModel->hapusMatakuliahHasCpmk($id);
        if ($delete) {
            return redirect()->to('/matakuliah/edit/' . $k);
        }
    }

    public function sesuaikan()
	{ 
		if ($this->request->getPost('pilih')) {
			$kode = $this->request->getPost('kode');
            $idEdit = 1;
			
            //dd($kode);
			if (!empty($idEdit)) {
				$saveData = [
					'kode_kurikulum' => $kode,
				];
				
				//dd($saveData);
				$query = $this->kurikulumTerpilihModel->submitEdit($saveData,$idEdit); 

				//dd($query);
                session()->setFlashdata('success', 'Data Kurikulum '.$kode.' berhasil disesuaikan.');
                return redirect()->to('matakuliah');
			} else {
				// Handle case where required fields are empty
				// You can add a flash message or redirect with an error
				return redirect()->back()->withInput()->with('error', 'Data tidak lengkap.');
			}
		} 
	}
}
 