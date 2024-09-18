<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluasiLModel extends Model
{
    protected $table = 'mahasiswa'; // Nama tabel utama, bisa disesuaikan nanti jika metode menggunakan tabel lain
    protected $primaryKey = 'nim'; // Primary key, sesuaikan dengan tabel utama Anda
    protected $allowedFields = ['field1', 'field2', 'field3']; // Sesuaikan dengan kolom tabel Anda

    public function getTahunMasukSelect($tahunMin, $tahunMax)
    {
        return $this->db->table('mahasiswa')
                        ->select('tahun_masuk')
                        ->distinct()
                        ->where('tahun_masuk >=', $tahunMin)
                        ->where('tahun_masuk <=', $tahunMax)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl1($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_1')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl2($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_2')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl3($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_3')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl4($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_4')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl5($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_5')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl6($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_6')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl7($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_7')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }

    public function getAvgCpl8($key)
    {
        return $this->db->table('spk_cpltlang')
                        ->selectAvg('cpl_8')
                        ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
                        ->where('tahun_masuk', $key)
                        ->get()
                        ->getResult();
    }
}
?>
