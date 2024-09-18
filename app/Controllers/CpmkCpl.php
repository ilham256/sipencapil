<?php

namespace App\Controllers;

use App\Models\CpmkCplModel;
use App\Models\FormulaModel;
use App\Models\KurikulumTerpilihModel;

class CpmkCpl extends BaseController
{
    protected $cpmkCplModel;
    protected $formulaModel;
    protected $kurikulumTerpilihModel;

    public function __construct() {
        $this->cpmkCplModel = new CpmkCplModel();
        $this->formulaModel = new FormulaModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();
        $session = session();
        if (!$session->get('loggedin') || $session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index() { 
        $data['breadcrumbs'] = 'cpmk_cpl';
        $data['content'] = 'vw_cpmk_cpl';

        $kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

        $data['data_cpl'] = $this->cpmkCplModel->getCpl($data['kurikulum_terpilih']);

        usort($data['data_cpl'], function($a, $b) {
            // Ambil angka dari id_cpl_langsung untuk dibandingkan
            $a_number = (int) str_replace('CPL_', '', $a->id_cpl);
            $b_number = (int) str_replace('CPL_', '', $b->id_cpl);
            
            return $a_number - $b_number;
        });

        

        

        $data['data_cpmk'] = $this->cpmkCplModel->getCpmk();
        $data['rumus_deskriptor'] = $this->cpmkCplModel->getCplRumusDeskriptor($data['kurikulum_terpilih']);

        $data['status_aktif'] = 'show active';
        $data['naf'] = 'active';

        //dd($data);

        return view('vw_template', $data);
    }

    // CPL
    public function tambahCpl() {
        $data['breadcrumbs'] = 'cpmk_cpl';
        $data['content'] = 'cpl/tambah';
        return view('vw_template', $data);
    }

    public function submitTambahCpl() {
        if ($this->request->getPost('simpan')) {

            $kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
            //dd($kurikulum_terpilih[0]->kode_kurikulum);
            $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];

            $saveData = [
                'id_cpl_langsung' => $data['kurikulum_terpilih']."_".str_replace(' ', '_', $this->request->getPost('nama_cpl', FILTER_SANITIZE_STRING)),
                'id_cpl' => str_replace(' ', '_', $this->request->getPost('nama_cpl', FILTER_SANITIZE_STRING)),
                'nama' => $this->request->getPost('nama_cpl', FILTER_SANITIZE_STRING),
                'deskripsi' => $this->request->getPost('deskripsi', FILTER_SANITIZE_STRING),
                'kode_kurikulum' => $data['kurikulum_terpilih']
            ];

            if ($this->cpmkCplModel->submitTambahCpl($saveData)) {
                return redirect()->to('cpmkcpl');
            }
        }
    }

    public function editCpl($id) {
        $edit = $this->cpmkCplModel->editCpl($id);
        $data['data'] = $edit;
        $data['breadcrumbs'] = 'cpmk_cpl';
        $data['content'] = 'cpl/edit';
        return view('vw_template', $data);
    }

    public function submitEditCpl() {
        if ($this->request->getPost('simpan')) {
            $saveData = [
                'nama' => $this->request->getPost('nama_cpl'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];

            $idEdit = $this->request->getPost('id');

            if ($this->cpmkCplModel->submitEditCpl($saveData, $idEdit)) {
                return redirect()->to('cpmkcpl');
            }
        }
    }

    public function hapusCpl($id) {
        if ($this->cpmkCplModel->hapusCpl($id)) {
            return redirect()->to('cpmkcpl');
        }
    }

    // CPMK
    public function tambahCpmk() {
        $data['breadcrumbs'] = 'cpmk_cpl';
        $data['content'] = 'cpmk/tambah';
        return view('vw_template', $data);
    }

    public function submitTambahCpmk() {
        if ($this->request->getPost('simpan')) {
            $saveData = [
                'id_cpmk_langsung' => str_replace(' ', '_', $this->request->getPost('nama_cpmk')),
                'nama' => $this->request->getPost('nama_cpmk'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];

            if ($this->cpmkCplModel->submitTambahCpmk($saveData)) {
                return redirect()->to('cpmkcpl');
            }
        }
    }

    public function editCpmk($id) {
        $edit = $this->cpmkCplModel->editCpmk($id);
        $data['data'] = $edit;
        $data['breadcrumbs'] = 'cpmk_cpl';
        $data['content'] = 'cpmk/edit';
        return view('vw_template', $data);
    }

    public function submitEditCpmk() {
        if ($this->request->getPost('simpan')) {
            $saveData = [
                'nama' => $this->request->getPost('nama_cpmk'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];

            $idEdit = $this->request->getPost('id');

            if ($this->cpmkCplModel->submitEditCpmk($saveData, $idEdit)) {
                return redirect()->to('cpmkcpl');
            }
        }
    }

    public function hapusCpmk($id) {
        if ($this->cpmkCplModel->hapusCpmk($id)) {
            return redirect()->to('cpmkcpl');
        }
    }

    // Deskriptor
    public function tambahDeskriptor($id) {
        $edit = $this->formulaModel->getDataCpl($id);
        $data['data'] = $edit;
        $data['breadcrumbs'] = 'formula_deskriptor';
        $data['content'] = 'formula_deskriptor/tambah_deskriptor';
        return view('vw_template', $data);
    }
}
