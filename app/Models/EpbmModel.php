<?php

namespace App\Models;

use CodeIgniter\Model;

class EpbmModel extends Model
{
    protected $table = 'psd'; // Nama tabel utama, bisa disesuaikan nanti jika metode menggunakan tabel lain
    protected $primaryKey = 'id'; // Primary key, sesuaikan dengan tabel utama Anda
    protected $allowedFields = ['field1', 'field2', 'field3']; // Sesuaikan dengan kolom tabel Anda

    public function getEpbm()
    {
        return $this->db->table('psd')->get()->getResult();
    }

    public function getPsd()
    {
        return $this->db->table('psd')->get()->getResult();
    }

    public function updateExcelEpbmMataKuliah($saveData)
    {
        return $this->db->table('epbm_mata_kuliah')->replace($saveData);
    }

    public function updateExcelDosen($saveData)
    {
        return $this->db->table('dosen')->replace($saveData);
    }

    public function updateExcelEpbmMataKuliahHasDosen($saveData)
    {
        return $this->db->table('epbm_mata_kuliah_has_dosen')->replace($saveData);
    }

    public function updateExcelNilaiEpbmMataKuliah($saveData)
    {
        return $this->db->table('nilai_epbm_mata_kuliah')->replace($saveData);
    }

    public function updateExcelNilaiEpbmDosen($saveData)
    {
        return $this->db->table('nilai_epbm_dosen')->replace($saveData);
    }

    public function cekDosen($data)
    {
        return $this->db->table('dosen')
                        ->select('*')
                        ->where('NIP', $data)
                        ->get()
                        ->getResult();
    }

    public function cekMataKuliahKode1($data)
    {
        return $this->db->table('mata_kuliah')
                        ->select('*')
                        ->where('nama_kode', $data)
                        ->get()
                        ->getResult();
    }

    public function cekMataKuliahKode2($data)
    {
        return $this->db->table('mata_kuliah')
                        ->select('*')
                        ->where('nama_kode_2', $data)
                        ->get()
                        ->getResult();
    }

    public function cekMataKuliahKode3($data)
    {
        return $this->db->table('mata_kuliah')
                        ->select('*')
                        ->where('nama_kode_3', $data)
                        ->get()
                        ->getResult();
    }

    public function cekEpbmMataKuliah($data)
    {
        return $this->db->table('epbm_mata_kuliah')
                        ->select('kode_epbm_mk')
                        ->where('kode_epbm_mk', $data)
                        ->get()
                        ->getResult();
    }

    public function cekEpbmMataKuliahHasDosen($data)
    {
        return $this->db->table('epbm_mata_kuliah_has_dosen')
                        ->select('kode_epbm_mk_has_dosen')
                        ->where('kode_epbm_mk_has_dosen', $data)
                        ->get()
                        ->getResult();
    }
}
?>
