<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model 
{
    protected $table = '';
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key yang sesuai

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getCpmklangSelect($dataTahunMasuk, $dataMataKuliah)  
    {
        return $this->db->table('spk_cpmklang')
            ->select('*')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = spk_cpmklang.kode_mk')
            ->where('tahun_masuk', $dataTahunMasuk)
            ->where('kode_mk', $dataMataKuliah)
            ->get()
            ->getResult();
    }

    public function getNamaMahasiswa($nim)  
    {
        return $this->db->table('mahasiswa')
            ->select('nama')
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getMahasiswaSelect($nim)  
    {
        return $this->db->table('mahasiswa')
            ->select('*')
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getMahasiswaCpl($nim)  
    {
        return $this->db->table('spk_cpltlang')
            ->select('*')
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getCpmklang()   
    {
        return $this->db->table('spk_cpmklang')
            ->select('*')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = spk_cpmklang.kode_mk')
            ->get()
            ->getResult();
    }

    public function getMkCpmk($key)  
    {
        return $this->db->table('matakuliah_has_cpmk')
            ->select('*')
            ->where('kode_mk', $key)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmk($key, $nim)  
    {
        return $this->db->table('nilai_cpmk')
            ->select('*')
            ->where('id_matakuliah_has_cpmk', $key)
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmkSelect($id)  
    {
        return $this->db->table('nilai_cpmk')
            ->select('*')
            ->where('id_nilai', $id)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmkTl($key, $nim)  
    {
        return $this->db->table('nilai_cpmk_tak_langsung')
            ->select('*')
            ->where('id_matakuliah_has_cpmk', $key)
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getCpl()  
    {
        return $this->db->table('cpl_langsung')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getDataMk($id)  
    {
        return $this->db->table('mata_kuliah')
            ->select('*')
            ->where('kode_mk', $id)
            ->get()
            ->getResult();
    }

    public function getRelevansiPpm()  
    {
        return $this->db->table('relevansi_ppm')
            ->select('id_relevansi_ppm')
            ->get()
            ->getResult();
    }

    public function getPpm()  
    {
        return $this->db->table('ppm')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getNilaiPpmCpl($cpl, $relevansiPpm)  
    {
        return $this->db->table('nilai_relevansi_ppm_cpl')
            ->select('*')
            ->where('id_relevansi_ppm', $relevansiPpm)
            ->where('id_cpl_langsung', $cpl)
            ->get()
            ->getResult();
    }

    public function getNilaiPpm($ppm, $relevansiPpm)  
    {
        return $this->db->table('nilai_relevansi_ppm')
            ->select('nilai_relevansi_ppm')
            ->where('id_relevansi_ppm', $relevansiPpm)
            ->where('id_ppm', $ppm)
            ->get()
            ->getResult();
    }

    public function getMahasiswa()  
    {
        return $this->db->table('mahasiswa')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getNilaiEfektivitasCpl($cpl, $nim)  
    {
        return $this->db->table('nilai_efektivitas_cpl')
            ->select('nilai')
            ->where('nim', $nim)
            ->where('id_cpl_langsung', $cpl)
            ->get()
            ->getResult();
    }

    public function getPsd()   
    {
        return $this->db->table('psd')
            ->select('*')
            ->orderBy('nama')
            ->get()
            ->getResult();
    }

    public function getDosen()   
    {
        return $this->db->table('dosen')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getNilaiEpbmDosen($tahun, $semester, $d)   
    {
        return $this->db->table('nilai_epbm_dosen')
            ->select('*')
            ->where('tahun', $tahun)
            ->where('semester', $semester)
            ->where('kode_epbm_mk_has_dosen', $d)
            ->get()
            ->getResult();
    }

    public function getNilaiRaportEpbmDosen($tahun, $semester, $d)   
    {
        return $this->db->table('nilai_epbm_dosen')
            ->select('*')
            ->where('tahun', $tahun)
            ->where('semester', $semester)
            ->where('kode_epbm_mk_has_dosen', $d)
            ->get()
            ->getResult();
    }

    public function getNilaiEpbmMk($tahun, $semester, $d)   
    {
        return $this->db->table('nilai_epbm_mata_kuliah')
            ->select('*')
            ->where('tahun', $tahun)
            ->where('semester', $semester)
            ->where('kode_epbm_mk', $d)
            ->get()
            ->getResult();
    }

    public function getEpbmMataKuliahHasDosen()   
    {
        return $this->db->table('epbm_mata_kuliah_has_dosen')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getEpbmMataKuliahHasDosenSelect($dosen)   
    {
        return $this->db->table('epbm_mata_kuliah_has_dosen')
            ->select('*')
            ->join('epbm_mata_kuliah', 'epbm_mata_kuliah.kode_epbm_mk = epbm_mata_kuliah_has_dosen.kode_epbm_mk')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = epbm_mata_kuliah.kode_mk')
            ->where('NIP', $dosen)
            ->get()
            ->getResult();
    }

    public function getEpbmMataKuliahHasDosenMkSelect($mk)   
    {
        return $this->db->table('epbm_mata_kuliah_has_dosen')
            ->select('*')
            ->join('epbm_mata_kuliah', 'epbm_mata_kuliah.kode_epbm_mk = epbm_mata_kuliah_has_dosen.kode_epbm_mk')
            ->join('dosen', 'dosen.NIP = epbm_mata_kuliah_has_dosen.NIP')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = epbm_mata_kuliah.kode_mk')
            ->where('epbm_mata_kuliah.kode_mk', $mk)
            ->get()
            ->getResult();
    }

    public function getTahun()   
    {
        return $this->db->table('nilai_epbm_dosen')
            ->select('tahun')
            ->distinct()
            ->get()
            ->getResult();
    }

    public function getEpbmMataKuliah()   
    {
        return $this->db->table('epbm_mata_kuliah')
            ->select('*')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = epbm_mata_kuliah.kode_mk')
            ->get()
            ->getResult();
    }
}

?>
