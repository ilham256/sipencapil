<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluasiTLModel extends Model
{
    protected $table = 'spk_cpltlang';
     protected $tablemahasiswa = 'mahasiswa';
    protected $allowedFields = ['nim', 'cpl_1', 'cpl_2', 'cpl_3', 'cpl_4', 'cpl_5', 'cpl_6', 'cpl_7', 'cpl_8'];

    public function getTahunMasukSelect($tahun_min, $tahun_max)
    {
        return $this->db->table('mahasiswa')
            ->select('tahun_masuk')
            ->distinct()
            ->where('tahun_masuk >=', $tahun_min)
            ->where('tahun_masuk <=', $tahun_max)
            ->get()
            ->getResult();
    }

    public function getAvgCpl1($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_1')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }

    public function getAvgCpl2($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_2')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }

    public function getAvgCpl3($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_3')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }

    public function getAvgCpl4($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_4')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }

    public function getAvgCpl5($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_5')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }

    public function getAvgCpl6($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_6')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }

    public function getAvgCpl7($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_7')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }

    public function getAvgCpl8($key)
    {
        return $this->db->table($this->table)
            ->selectAvg('cpl_8')
            ->join('mahasiswa', 'mahasiswa.nim = spk_cpltlang.nim')
            ->where('tahun_masuk', $key)
            ->get()
            ->getResult();
    }
}
?>
