<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\FormulaDeskriptorModel;
use App\Models\KurikulumTerpilihModel;
use CodeIgniter\Controller;

class ProfilMatakuliah extends BaseController
{
    protected $matakuliahModel;
    protected $formulaDeskriptorModel;
    protected $kurikulumTerpilihModel;
    protected $session;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->formulaDeskriptorModel = new FormulaDeskriptorModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();
        $this->session = \Config\Services::session();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }
 
    public function index()
    {
        $data['breadcrumbs'] = 'profil_matakuliah';
        $data['content'] = 'vw_profil_matakuliah';
        $data['data_semester'] = $this->matakuliahModel->getSemester();
        $data['rumus'] = $this->matakuliahModel->getMkMatakuliahHasCpmkAll();
        $data['cpmk'] = $this->matakuliahModel->getCpmk();
        $array_kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        $data['kurikulum_terpilih'] = $array_kurikulum_terpilih[0]['kode_kurikulum'];

        if ($this->request->getPost('pilih')) {
            $semester = $this->request->getPost('semester');
            $data['datas'] = $this->matakuliahModel->getSelectMatakuliah($semester);
        } else {
            $data['datas'] = $this->matakuliahModel->getMatakuliahKurikulum($data['kurikulum_terpilih']);
        }
        ($data);

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

            // Memeriksa apakah primary key sudah ada
            if ($this->matakuliahModel->cekIdMatakuliahHasCpmk($save_data['id_matakuliah_has_cpmk'])) {
                // Jika primary key sudah ada, kembalikan pesan error
                session()->setFlashdata('error', "Gagal ditambahkan! data " . $save_data['id_cpmk_langsung'] . " pada Matakuliah Kode: " . $save_data['kode_mk'] . " sudah ada!");
                return redirect()->to('/profilmatakuliah');
            } else {
                $query = $this->matakuliahModel->submitTambahMatakuliahHasCpmk($save_data);
                if ($query) {
                    session()->setFlashdata('success', "Berhasil ditambahkan! data " . $save_data['id_cpmk_langsung'] . " pada Matakuliah Kode: " . $save_data['kode_mk']);
                } else {
                    session()->setFlashdata('error', "Gagal menyimpan data!");
                }
                return redirect()->to('/profilmatakuliah');
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
                session()->setFlashdata('success', "Berhasil diubah! data " . $save_data['id_cpmk_langsung'] . " pada Matakuliah Kode: " . $kode_mk);
                return redirect()->to('/profilmatakuliah');
            }
        }
    }

    public function hapus_matakuliah_has_cpmk($id)
    {
        $kode_mk = $this->matakuliahModel->getMkMatakuliahHasCpmk($id);
        $k = $kode_mk[0]->kode_mk;

        $delete = $this->matakuliahModel->hapusMatakuliahHasCpmk($id);
        if ($delete) {
            session()->setFlashdata('success', $id . "Berhasil dihapus, pada Matakuliah Kode: " . $k);
            return redirect()->to('/profilmatakuliah');
        }
    }
} 
