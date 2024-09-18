<?php

namespace App\Models;

use CodeIgniter\Model;

class KincpmkModel extends Model
{
    protected $tableSpkCpmklang = 'spk_cpmklang';
    protected $tableSpkCpmktlang = 'spk_cpmktlang';
    protected $tableMahasiswa = 'mahasiswa';
    protected $tableMataKuliah = 'mata_kuliah';
    protected $tableMatakuliahHasCpmk = 'matakuliah_has_cpmk';
    protected $tableNilaiCpmk = 'nilai_cpmk';

    public function getCpmklangSelect($dataTahunMasuk, $dataMataKuliah)  
    {
        return $this->db->table($this->tableSpkCpmklang)
            ->select('*')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmklang.nim')
            ->join($this->tableMataKuliah, 'mata_kuliah.kode_mk = spk_cpmklang.kode_mk')
            ->where('tahun_masuk', $dataTahunMasuk)
            ->where('kode_mk', $dataMataKuliah)
            ->get()
            ->getResult();
    }

    public function getCpmklang()   
    {
        return $this->db->table($this->tableSpkCpmklang)
            ->select('*')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmklang.nim')
            ->join($this->tableMataKuliah, 'mata_kuliah.kode_mk = spk_cpmklang.kode_mk')
            ->get()
            ->getResult();
    }

    public function getCpmklangKurikulumTerpilih($id)   
    {
        return $this->db->table($this->tableSpkCpmklang)
            ->select('*')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmklang.nim')
            ->join($this->tableMataKuliah, 'mata_kuliah.kode_mk = spk_cpmklang.kode_mk')
            ->where('mata_kuliah.kode_kurikulum', $id)
            ->get()
            ->getResult();
    } 

    public function getCpmklangAvgAllCpmklangA($key, $tahun)  
    {
        return $this->db->table($this->tableSpkCpmklang)
            ->selectAvg('cpmklang_a')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmklang.nim')
            ->where('kode_mk', $key)
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getCpmklangAvgAllCpmklangB($key, $tahun)  
    {
        return $this->db->table($this->tableSpkCpmklang)
            ->selectAvg('cpmklang_b')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmklang.nim')
            ->where('kode_mk', $key)
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getCpmklangAvgAllCpmklangC($key, $tahun)  
    {
        return $this->db->table($this->tableSpkCpmklang)
            ->selectAvg('cpmklang_c')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmklang.nim')
            ->where('kode_mk', $key)
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getCpmktlangAvgAllCpmktlangA($key, $tahun)  
    {
        return $this->db->table($this->tableSpkCpmktlang)
            ->selectAvg('cpmktlang_a')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmktlang.nim')
            ->where('kode_mk', $key)
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getCpmktlangAvgAllCpmktlangB($key, $tahun)  
    {
        return $this->db->table($this->tableSpkCpmktlang)
            ->selectAvg('cpmktlang_b')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmktlang.nim')
            ->where('kode_mk', $key)
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getCpmktlangAvgAllCpmktlangC($key, $tahun)  
    {
        return $this->db->table($this->tableSpkCpmktlang)
            ->selectAvg('cpmktlang_c')
            ->join($this->tableMahasiswa, 'mahasiswa.nim = spk_cpmktlang.nim')
            ->where('kode_mk', $key)
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getMkCpmk($key)   
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->select('*')
            ->where('kode_mk', $key)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmk($key, $nim)  
    {
        return $this->db->table($this->tableNilaiCpmk)
            ->select('*')
            ->where('id_matakuliah_has_cpmk', $key)
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmkSelect($id)  
    {
        return $this->db->table($this->tableNilaiCpmk)
            ->select('*')
            ->where('id_nilai', $id)
            ->get()
            ->getResult();
    }
}
?>
