<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MatakuliahModel;
use App\Models\SemesterModel;
use App\Models\CpmkCplModel;
use App\Models\MatakuliahModel as MatakuliahModel;
use App\Models\KatkinModel;
use App\Models\FormulaModel;
use App\Models\FormulaDeskriptorModel;
use App\Models\CpmklangModel;
use App\Models\CpmktlangModel;
use App\Models\CpltlangModel;
use App\Models\EfektivitasCplModel;
use App\Models\RelevansiPpmModel;
use App\Models\EpbmModel;
use App\Models\MahasiswaModel;

class InputAsesmenGuest extends Controller
{
    protected $session;
    protected $semesterModel;
    protected $matakuliahModel;
    protected $cpmkCplModel;
    protected $katkinModel;
    protected $formulaModel;
    protected $formulaDeskriptorModel;
    protected $cpmklangModel;
    protected $cpmktlangModel;
    protected $cpltlangModel;
    protected $efektivitasCplModel;
    protected $relevansiPpmModel;
    protected $epbmModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        $this->semesterModel = new SemesterModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->cpmkCplModel = new Cpmk_cplModel();
        $this->katkinModel = new KatkinModel();
        $this->formulaModel = new FormulaModel();
        $this->formulaDeskriptorModel = new Formula_deskriptorModel();
        $this->cpmklangModel = new CpmklangModel();
        $this->cpmktlangModel = new CpmktlangModel();
        $this->cpltlangModel = new CpltlangModel();
        $this->efektivitasCplModel = new Efektivitas_cplModel();
        $this->relevansiPpmModel = new Relevansi_ppmModel();
        $this->epbmModel = new EpbmModel();
        $this->mahasiswaModel = new MahasiswaModel();

        helper(['form', 'url']);
    }

    public function kurikulum()
    {
        $data['breadcrumbs'] = 'kurikulum';
        $data['content'] = 'login_guest/vw_kurikulum';

        $semesters = $this->semesterModel->getSemesters("asc");
        $dictionary = [];

        foreach ($semesters as $semester) {
            $mataKuliah = $this->matakuliahModel->getSelectMatakuliah($semester->id_semester);
            $dictionary[$semester->id_semester] = $mataKuliah;
        }

        $data['dictionary'] = $dictionary;
        $data['semesters'] = $semesters;

        return view('vw_template_guest', $data);
    }

    public function cpmkCpl()
    {
        $data['breadcrumbs'] = 'cpmk_cpl';
        $data['content'] = 'login_guest/vw_cpmk_cpl';

        $data['dataCpl'] = $this->cpmkCplModel->getCpl();
        $data['dataCpmk'] = $this->cpmkCplModel->getCpmk();
        $data['rumusDeskriptor'] = $this->cpmkCplModel->getCplRumusDeskriptor();

        $data['statusAktif'] = 'show active';
        $data['naf'] = 'active';

        return view('vw_template_guest', $data);
    }

    public function matakuliah()
    {
        $data['breadcrumbs'] = 'matakuliah';
        $data['content'] = 'login_guest/vw_matakuliah';
        $data['dataSemester'] = $this->matakuliahModel->getSemester();

        if (!empty($this->request->getPost('pilih'))) {
            $semester = $this->request->getPost('semester');
            $data['datas'] = $this->matakuliahModel->getSelectMatakuliah($semester);
        } else {
            $data['datas'] = $this->matakuliahModel->getMatakuliah();
        }

        return view('vw_template_guest', $data);
    }

    public function profilMatakuliah()
    {
        $data['breadcrumbs'] = 'profil_matakuliah';
        $data['content'] = 'login_guest/vw_profil_matakuliah';
        $data['dataSemester'] = $this->matakuliahModel->getSemester();
        $data['rumus'] = $this->matakuliahModel->getMkMatakuliahHasCpmkAll();

        if (!empty($this->request->getPost('pilih'))) {
            $semester = $this->request->getPost('semester');
            $data['datas'] = $this->matakuliahModel->getSelectMatakuliah($semester);
        } else {
            $data['datas'] = $this->matakuliahModel->getMatakuliah();
        }

        return view('vw_template_guest', $data);
    }

    public function katkin()
    {
        $data['breadcrumbs'] = 'katkin';
        $data['content'] = 'login_guest/vw_kategori_kinerja_info';
        $data['data'] = $this->katkinModel->getKatkin();

        return view('vw_template_guest', $data);
    }

    public function formula()
    {
        $data['breadcrumbs'] = 'formula';
        $data['content'] = 'login_guest/vw_formula';

        $data['datas'] = $this->formulaModel->getFormulaCpl();
        $data['rumusDeskriptor'] = $this->formulaModel->getCplRumusDeskriptor();
        $data['dataDeskriptor'] = $this->formulaDeskriptorModel->getDeskriptor();
        $data['rumus'] = $this->formulaDeskriptorModel->getDeskriptorRumusCpmk();

        return view('vw_template_guest', $data);
    }

	 public function cpmklang()
    {
        $data['breadcrumbs'] = 'cpmklang';
        $data['content'] = 'login_guest/vw_cpmklang';
        $data['error'] = '';
        $data['message'] = '';
        $data['mata_kuliah'] = $this->matakuliahModel->getMatakuliah();
        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();
        $data['simpanan_tahun'] = " - Pilih Tahun - ";
        $data['tahun'] = 2017;
        $data['t_simpanan_tahun'] = " ";
        $data['simpanan_mk'] = " - Pilih Mata Kuliah - ";
        $data['simpanan_nama_mk'] = " - Pilih Mata Kuliah - ";

        if ($this->request->getPost('pilih')) {
            $data_tahun_masuk = $this->request->getPost('tahun_masuk');
            $data_mata_kuliah = $this->request->getPost('mata_kuliah');
            $data['datas'] = $this->cpmklangModel->getCpmklang($data_mata_kuliah);
            $data['data_matakuliah_has_cpmk'] = $this->cpmklangModel->getMatakuliahHasCpmk($data_mata_kuliah);
            $data['data_mahasiswa'] = $this->cpmklangModel->getMahasiswa($data_tahun_masuk);
            $data['tahun'] = $data_tahun_masuk;
            $data['simpanan_tahun'] = $data_tahun_masuk;
            $data['t_simpanan_tahun'] = "/" . ($data_tahun_masuk + 1);
            $data['simpanan_mk'] = $data_mata_kuliah;
            $nama_mk = $this->matakuliahModel->getNamaMk($data_mata_kuliah);
            $data['simpanan_nama_mk'] = ($nama_mk[0]->nama_kode) . ' (' . ($nama_mk[0]->nama_mata_kuliah) . ')';
        } else {
            $data['datas'] = [];
            $data['data_matakuliah_has_cpmk'] = $this->cpmklangModel->getMatakuliahHasCpmk('');
            $data['data_mahasiswa'] = $this->cpmklangModel->getMahasiswa('');
        }

        // Panggil API menggunakan cURL
        $send = $this->curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=" . $data['tahun']);
        $mahasiswa = json_decode($send, true);
        $data['data_mahasiswa'] = $mahasiswa;

        return view('vw_template_guest', $data);
    }

    // Metode cURL untuk panggilan API
    private function curl($url)
    {
        $ch = curl_init();
        $headers = array(
            'accept: text/plain',
            'X-IPBAPI-TOKEN: Bearer 86f2760d-7293-36f4-833f-1d29aaace42e'
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

	 public function cpmktlang()
    {
        $data['breadcrumbs'] = 'cpmktlang';
        $data['content'] = 'login_guest/vw_cpmktlang';
        $data['mata_kuliah'] =  $this->MatakuliahModel->getmatakuliah();
        $data['tahun_masuk'] =  $this->MahasiswaModel->gettahunmasuk();
        $data['simpanan_tahun'] = " - Pilih Tahun - ";
        $data['tahun'] = 2019;
        $data['t_simpanan_tahun'] = " ";
        $data['simpanan_mk'] = " - Pilih Mata Kuliah - ";
        $data['simpanan_nama_mk'] = " - Pilih Mata Kuliah - ";
        
        if ($this->request->getPost('pilih')) {
            $data_tahun_masuk = $this->request->getPost('tahun_masuk');
            $data_mata_kuliah = $this->request->getPost('mata_kuliah');
            $data['datas'] =  $this->cpmktlangModel->getcpmktlang($data_mata_kuliah);
            $data['data_matakuliah_has_cpmk'] =  $this->cpmktlangModel->getmatakuliahhascpmk($data_mata_kuliah);
            $data['data_mahasiswa'] =  $this->cpmktlangModel->getmahasiswa($data_tahun_masuk);
            $data['tahun'] = $data_tahun_masuk;
            $data['simpanan_tahun'] = $data_tahun_masuk;
            $data['t_simpanan_tahun'] = "/" . ($data_tahun_masuk + 1);
            $data['simpanan_mk'] = $data_mata_kuliah;
            $nama_mk = $this->MatakuliahModel->getnamamk($data_mata_kuliah);
            $data['simpanan_nama_mk'] = ($nama_mk["0"]->nama_kode) . ' (' . ($nama_mk["0"]->nama_mata_kuliah) . ')';
            $data['th'] = $data_tahun_masuk;
            $data['mk'] = $data_mata_kuliah;
        } else {
            $data['datas'] =  [];
            $data_mata_kuliah = 'TIN211';
            $data_tahun_masuk = 2019;
            $data['data_matakuliah_has_cpmk'] =  $this->cpmktlangModel->getmatakuliahhascpmk($data_mata_kuliah);
            $data['data_mahasiswa'] =  $this->cpmktlangModel->getmahasiswa($data_tahun_masuk);
            $data['datas'] =  $this->cpmktlangModel->getcpmktlang($data_mata_kuliah);
            $data['th'] = $data_tahun_masuk;
            $data['mk'] = $data_mata_kuliah;
        }

        // Panggil API menggunakan cURL
        $send = $this->curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=" . $data['tahun']);
        $mahasiswa = json_decode($send, TRUE);
        $data['data_mahasiswa'] =  $mahasiswa;

        return view('vw_template_guest', $data);
    }

	public function cpltlang()
    {
        $data['breadcrumbs'] = 'cpltlang';
        $data['content'] = 'login_guest/vw_cpltlang';

        $data['tahun_masuk'] = $this->mahasiswaModel->gettahunmasuk();
        $data['cpl'] = $this->cpltlangModel->getcpl();
        $data['simpanan_tahun'] = " - Pilih Tahun - ";
        $data['t_simpanan_tahun'] = " ";

        $data['datas'] = $this->cpltlangModel->getcpltlangall();

        $data_tahun_masuk = "";
        $data['data_mahasiswa'] = $this->cpltlangModel->getmahasiswaall();

        if ($this->request->getPost('pilih')) {
            $data_tahun_masuk = $this->request->getPost('tahun_masuk');

            $data['datas'] = $this->cpltlangModel->getcpltlang($data_tahun_masuk);
            $data['data_mahasiswa'] = $this->cpltlangModel->getmahasiswa($data_tahun_masuk);

            $data['simpanan_tahun'] = $data_tahun_masuk;
            $data['t_simpanan_tahun'] = "/" . ($data_tahun_masuk + 1);
        }

        return view('vw_template_guest', $data);
    }

    public function efektivitas_cpl()
    {
        $data['breadcrumbs'] = 'efektivitas_cpl';
        $data['content'] = 'login_guest/vw_efektivitas_cpl';

        $data['datas'] = $this->efektivitasCplModel->getrelevansippm();

        return view('vw_template_guest', $data);
    }

    public function relevansi_ppm()
    {
        $data['breadcrumbs'] = 'relevansi_ppm';
        $data['content'] = 'login_guest/vw_relevansi_ppm';

        $data['datas'] = $this->relevansiPpmModel->getrelevansippm();

        return view('vw_template_guest', $data);
    }

    public function epbm()
    {
        $data['breadcrumbs'] = 'epbm';
        $data['content'] = 'login_guest/vw_epbm';

        // $data['datas'] = $this->epbmModel->get_epbm();

        return view('vw_template_guest', $data);
    }
}
   