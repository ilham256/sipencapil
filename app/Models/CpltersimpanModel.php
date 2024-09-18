<?php

namespace App\Models;

use CodeIgniter\Model;

class CpltersimpanModel extends Model 
{
    protected $table = 'cpl_langsung'; // Anda dapat menetapkan tabel default jika diinginkan
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key tabel Anda
    protected $allowedFields = ['id_cpl_langsung', 'tahun_masuk', 'nim', 'nilai']; // Sesuaikan dengan kolom yang diizinkan

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

    public function getCplTersimpan($data_tahun_masuk)
    {
        return $this->db->table('nilai_cpl_tersimpan')
                        ->select('nilai_cpl_tersimpan.*, mahasiswa.*')
                        ->join('mahasiswa', 'mahasiswa.nim = nilai_cpl_tersimpan.nim')
                        ->where('mahasiswa.tahun_masuk', $data_tahun_masuk)
                        ->get()
                        ->getResult();
    }

    public function getCplTersimpanAll()
    {
        return $this->db->table('nilai_cpl_tersimpan')
                        ->select('nilai_cpl_tersimpan.*, mahasiswa.*')
                        ->join('mahasiswa', 'mahasiswa.nim = nilai_cpl_tersimpan.nim')
                        ->get()
                        ->getResult();
    }

    public function updateExcel($save_data)
    {
        // Gunakan metode `replace` untuk menyimpan data
        return $this->db->table('nilai_cpl_tersimpan')->replace($save_data);
    }
}
?>
