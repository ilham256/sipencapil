<?php

namespace App\Controllers;

use App\Models\KurikulumModel;
use App\Models\KurikulumTerpilihModel;

class Kurikulum extends BaseController
{
    protected $kurikulumModel;
    protected $kurikulumTerpilihModel;
 
    public function __construct() {
        $this->kurikulumModel = new KurikulumModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();
        $session = session();
        if (!$session->get('loggedin') || $session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index() {
        $data['breadcrumbs'] = 'kurikulum';
        $data['content'] = 'vw_kurikulum';

        $data['kurikulum'] = $this->kurikulumModel->get("asc");
        $kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

       // dd($data['kurikulum_terpilih']);

        return view('vw_template', $data);
    }

    public function submit_tambah()
	{ 
		if ($this->request->getPost('simpan')) {
			$kode = $this->request->getPost('kode');
			$nama = $this->request->getPost('nama');
            $tahun = $this->request->getPost('tahun');
			$keterangan = $this->request->getPost('keterangan');
			
			if (!empty($kode)) {
				$KL = [
					'kode_kurikulum' => $kode,
					'nama' => $nama,
					'tahun' => $tahun,
                    'keterangan' => $keterangan,
				];
				
				//dd($saveData);
				$query = $this->kurikulumModel->submitTambah($KL); 

				//dd($query);
                session()->setFlashdata('success', 'Data berhasil disimpan!');
				
                return redirect()->to('kurikulum');
			} else {
				// Handle case where required fields are empty
				// You can add a flash message or redirect with an error
				return redirect()->back()->withInput()->with('error', 'Data tidak lengkap.');
			}
		} 
	}

    public function edit()
	{ 
		if ($this->request->getPost('simpan')) {
			$idEdit = $this->request->getPost('kode');
			$nama = $this->request->getPost('nama');
            $tahun = $this->request->getPost('tahun');
			$keterangan = $this->request->getPost('keterangan');
			
			if (!empty($idEdit)) {
				$saveData = [
					'nama' => $nama,
					'tahun' => $tahun,
                    'keterangan' => $keterangan,
				];
				
				//dd($saveData);
				$query = $this->kurikulumModel->submitEdit($saveData,$idEdit); 

				//dd($query);
                session()->setFlashdata('success', 'Data Kurikulum '.$idEdit.' - '.$nama.' berhasil diedit!');
				
                return redirect()->to('kurikulum');
			} else {
				// Handle case where required fields are empty
				// You can add a flash message or redirect with an error
				return redirect()->back()->withInput()->with('error', 'Data tidak lengkap.');
			}
		} 
	}

	public function hapus($id)
    {	
		$kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $kode_kurikulum_terpilih = $kurikulum_terpilih[0]['kode_kurikulum'];
		
		//dd($id,$kode_kurikulum_terpilih);
		if ($id != $kode_kurikulum_terpilih) {
			//dd($id,$kode_kurikulum_terpilih);
			$delete = $this->kurikulumModel->hapus($id);
			if ($delete) {
				
				session()->setFlashdata('success', 'Data Kurikulum '.$id.' berhasil dihapus!');

				return redirect()->to('kurikulum');
			}
		} else {
			
			session()->setFlashdata('error', 'Data Kurikulum Aktif Saat ini tidak dapat dihapus!');

			return redirect()->to('kurikulum');
		}
        
    }

    public function suksesSimpan()
    {
        $arr['breadcrumbs'] = 'dosen';
        $arr['content'] = 'vw_data_berhasil_disimpan';

        echo view('vw_template', $arr);
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
                return redirect()->to('kurikulum');
			} else {
				// Handle case where required fields are empty
				// You can add a flash message or redirect with an error
				return redirect()->back()->withInput()->with('error', 'Data tidak lengkap.');
			}
		} 
	}

	

}


