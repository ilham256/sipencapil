<?php

namespace App\Controllers;

use App\Models\FormulaModel;
use App\Models\FormulaDeskriptorModel;
use App\Models\KurikulumTerpilihModel;
use CodeIgniter\Controller;

class Formula extends BaseController
{
    protected $formulaModel;
    protected $formulaDeskriptorModel;
    protected $kurikulumTerpilihModel;
    protected $session;

    public function __construct()
    {
        $this->formulaModel = new FormulaModel();
        $this->formulaDeskriptorModel = new FormulaDeskriptorModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();
        $this->session = session();
        
        if (!$this->session->get('loggedin') || $this->session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    } 

    public function index() 
    {  
        $array_kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        $kurikulum_terpilih = $array_kurikulum_terpilih[0]['kode_kurikulum'];

        $data = [
            'breadcrumbs' => 'formula',
            'content' => 'vw_formula',
            'rumus_deskriptor' => $this->formulaModel->getcplrumusdeskriptor($kurikulum_terpilih),
            'data_deskriptor' => $this->formulaDeskriptorModel->getdeskriptor(),
            'rumus' => $this->formulaDeskriptorModel->getDeskriptorRumusCpmkKurikulumTerpilih($kurikulum_terpilih),
            'data_formula_cpmk' => $this->formulaDeskriptorModel->getmatakuliahhascpmk(),
            'kurikulum_terpilih' => $this->kurikulumTerpilihModel->get(),
        ];

        $data['datas'] = $this->formulaModel->getformulacpl($kurikulum_terpilih);

        usort($data['datas'], function($a, $b) {
            // Ambil angka dari id_cpl_langsung untuk dibandingkan
            $a_number = (int) str_replace('CPL_', '', $a->id_cpl);
            $b_number = (int) str_replace('CPL_', '', $b->id_cpl);
            
            return $a_number - $b_number;
        });
        //dd($data,$kurikulum_terpilih);
        return view('vw_template', $data);
    }

    public function tambah()
    {
        $data = [
            'breadcrumbs' => 'formula',
            'content' => 'formula/tambah'
        ];

        return view('vw_template', $data);
    }

    public function tambah_rumus_deskriptor($id)
    {
        $edit = $this->formulaModel->getdatacpl($id);
        $data = [
            'data' => $edit,
            'data_deskriptor' => $this->formulaModel->getdeskriptor(),
            'breadcrumbs' => 'formula',
            'content' => 'formula/tambah_rumus_deskriptor'
        ];

        return view('vw_template', $data);
    }

    public function submit_tambah()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'id_cpl_langsung' => str_replace(' ', '_', $this->request->getPost('nama_cpl')),
                'nama' => $this->request->getPost('nama_cpl'),
                'deskripsi' => $this->request->getPost('deskripsi'),
            ];

            $query = $this->formulaModel->submittambahcpl($save_data);
            if ($query) {
                return redirect()->to('formula');
            }
        }
    }

    public function edit($id)
    {
        $edit = $this->formulaModel->editcpl($id);
        $data = [
            'data' => $edit,
            'breadcrumbs' => 'formula',
            'content' => 'formula/edit'
        ];

        return view('vw_template', $data);
    }

    public function submit_edit()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'nama' => $this->request->getPost('nama_cpl'),
                'deskripsi' => $this->request->getPost('deskripsi'),
            ];

            $id_edit = $this->request->getPost('id');

            $query = $this->formulaModel->submiteditcpl($save_data, $id_edit);
            if ($query) {
                return redirect()->to('formula');
            }
        }
    }

    public function detail()
    {
        $data = [
            'breadcrumbs' => 'formula',
            'content' => 'vw_formula_detail'
        ];

        return view('vw_template', $data);
    }

    public function deskriptor()
    {
        $data = [
            'breadcrumbs' => 'formula',
            'content' => 'vw_formula_deskriptor'
        ];

        return view('vw_template', $data);
    }

    public function deskriptorn()
    {
        $data = [
            'breadcrumbs' => 'formula',
            'content' => 'vw_formula_deskriptorn'
        ];

        return view('vw_template', $data);
    }

    public function edit_rumus_deskriptor($id)
    {
        $edit = $this->formulaModel->editcplrumusdeskriptor($id);
        $data = [
            'data' => $edit,
            'data_deskriptor' => $this->formulaModel->getdeskriptor(),
            'breadcrumbs' => 'formula',
            'content' => 'formula/edit_rumus_deskriptor'
        ];

        dd($data);
        return view('vw_template', $data);
    }

    public function submit_tambah_rumus_deskriptor()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'id_cpl_rumus_deskriptor' => $this->request->getPost('id_cpl') . '_' . $this->request->getPost('deskriptor'),
                'id_cpl_langsung' => $this->request->getPost('id_cpl'),
                'id_deskriptor' => $this->request->getPost('deskriptor'),
                'persentasi' => $this->request->getPost('persentasi'),
            ];

            $query = $this->formulaModel->submittambahformuladeskriptor($save_data);
            if ($query) {
                return redirect()->to('cpmkcpl');
            }
        }
    }

    public function submit_edit_rumus_deskriptor()
    {
        if ($this->request->getPost('simpan')) {
            $save_data = [
                'id_deskriptor' => $this->request->getPost('deskriptor'),
                'persentasi' => $this->request->getPost('persentasi'),
            ];

            $id_edit = $this->request->getPost('id');

            $query = $this->formulaModel->submiteditformuladeskriptor($save_data, $id_edit);
            if ($query) {
                return redirect()->to('cpmkcpl');
            }
        }
    }

    public function hapus_rumus_deskriptor($id)
    {
        $delete = $this->formulaModel->hapusformuladeskriptor($id);
        if ($delete) {
            return redirect()->to('cpmkcpl');
        }
    }

    public function hapus_cpl($id)
    {
        $delete = $this->formulaModel->hapuscpl($id);
        if ($delete) {
            return redirect()->to('formula');
        }
    }
}
