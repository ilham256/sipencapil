<?php

namespace App\Models;

use CodeIgniter\Model;

class CpmklangModel extends Model
{
    protected $table = 'nilai_cpmk'; // Default table
    protected $primaryKey = 'id_matakuliah_has_cpmk'; // Default primary key, sesuaikan jika berbeda
    protected $allowedFields = ['field1', 'field2', 'field3']; // Sesuaikan dengan kolom tabel Anda

    public function getCpmkLang($dataMataKuliah)
    {
        return $this->db->table('nilai_cpmk')
                        ->select('*')
                        ->join('matakuliah_has_cpmk', 'matakuliah_has_cpmk.id_matakuliah_has_cpmk = nilai_cpmk.id_matakuliah_has_cpmk')
                        ->where('kode_mk', $dataMataKuliah)
                        ->get()
                        ->getResult();
    }

    public function getMahasiswa($dataTahunMasuk)
    {
        return $this->db->table('mahasiswa')
                        ->select('*')
                        ->where('tahun_masuk', $dataTahunMasuk)
                        ->get()
                        ->getResult();
    }

    public function getMatakuliahHasCpmk($dataMataKuliah)
    {
        return $this->db->table('matakuliah_has_cpmk')
                        ->select('*')
                        ->join('cpmk_langsung', 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
                        ->where('kode_mk', $dataMataKuliah)
                        ->get()
                        ->getResult();
    }

    public function cekMatakuliahHasCpmk($data)
    {
        return $this->db->table('matakuliah_has_cpmk')
                        ->select('id_matakuliah_has_cpmk')
                        ->where('id_matakuliah_has_cpmk', $data)
                        ->get()
                        ->getResult();
    }

    public function cekMatakuliahKode1($data)
    {
        return $this->db->table('mata_kuliah')
                        ->select('kode_mk')
                        ->where('nama_kode', $data)
                        ->get()
                        ->getResult();
    }

    public function cekMatakuliahKode2($data)
    {
        return $this->db->table('mata_kuliah')
                        ->select('kode_mk')
                        ->where('nama_kode_2', $data)
                        ->get()
                        ->getResult();
    }

    public function cekMatakuliahKode3($data)
    {
        return $this->db->table('mata_kuliah')
                        ->select('kode_mk')
                        ->where('nama_kode_3', $data)
                        ->get()
                        ->getResult();
    }

    public function updateExcel($saveData)
    {
        return $this->db->table('nilai_cpmk')
                        ->replace($saveData);
    }
}
?>
