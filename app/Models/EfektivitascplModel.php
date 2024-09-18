<?php

namespace App\Models;

use CodeIgniter\Model;

class EfektivitasCplModel extends Model
{
    protected $table = 'nilai_efektivitas_cpl'; // Nama tabel utama
    protected $primaryKey = 'id'; // Primary key, sesuaikan dengan tabel utama Anda
    protected $allowedFields = ['field1', 'field2', 'field3']; // Sesuaikan dengan kolom tabel Anda

    public function getRelevansiPpm()
    {
        return $this->db->table('relevansi_ppm')->get()->getResult();
    }

    public function getCpl()
    {
        return $this->db->table('cpl_langsung')->get()->getResult();
    }

    public function updateExcelNilaiEfektivitasCpl($saveData)
    {
        return $this->db->table($this->table)->replace($saveData);
    }

    public function cekCpl($data)
    {
        return $this->db->table('cpl_langsung')
                        ->select('id_cpl_langsung')
                        ->where('id_cpl_langsung', $data)
                        ->get()
                        ->getResult();
    }

    public function cekPpm($data)
    {
        return $this->db->table('ppm')
                        ->select('id')
                        ->where('id', $data)
                        ->get()
                        ->getResult();
    }
}
?>
