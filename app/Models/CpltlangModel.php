<?php

namespace App\Models;

use CodeIgniter\Model;

class CpltlangModel extends Model
{
    protected $table = 'cpl_langsung'; // Tabel default yang digunakan, jika diinginkan
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key tabel Anda
    protected $allowedFields = ['id_cpl_langsung', 'group_id', 'semester_id', 'warna', 'nim', 'tahun_masuk', 'nilai']; // Sesuaikan dengan kolom yang diizinkan

    public function getCpl()
    {
        return $this->findAll();
    }

    public function cekCpl($data)
    {
        return $this->select('id_cpl_langsung')
                    ->where('id_cpl_langsung', $data)
                    ->findAll();
    }

    public function getMahasiswa($data_tahun_masuk)
    {
        return $this->db->table('mahasiswa')
                        ->where('tahun_masuk', $data_tahun_masuk)
                        ->get()
                        ->getResult();
    }

    public function getMahasiswaAll()
    {
        return $this->db->table('mahasiswa')
                        ->get()
                        ->getResult();
    }

    public function getCpltlang($data_tahun_masuk)
    {
        return $this->db->table('nilai_cpl_tak_langsung')
                        ->select('nilai_cpl_tak_langsung.*, mahasiswa.*')
                        ->join('mahasiswa', 'mahasiswa.nim = nilai_cpl_tak_langsung.nim')
                        ->where('mahasiswa.tahun_masuk', $data_tahun_masuk)
                        ->get()
                        ->getResult();
    }

    public function getCpltlangAll()
    {
        return $this->db->table('nilai_cpl_tak_langsung')
                        ->select('nilai_cpl_tak_langsung.*, mahasiswa.*')
                        ->join('mahasiswa', 'mahasiswa.nim = nilai_cpl_tak_langsung.nim')
                        ->get()
                        ->getResult();
    }

    public function updateExcel($save_data)
    {
        return $this->db->table('nilai_cpl_tak_langsung')->replace($save_data);
    }
}
?>
