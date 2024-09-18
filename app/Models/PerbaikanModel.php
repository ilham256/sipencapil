<?php

namespace App\Models;

use CodeIgniter\Model;

class PerbaikanModel extends Model 
{
    protected $table = 'perbaikan_mata_kuliah';
    protected $primaryKey = 'id';
    protected $useTimestamps = false; // Sesuaikan dengan kebutuhan

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getPerbaikanMataKuliah()  
    {
        return $this->db->table($this->table)
            ->select('perbaikan_mata_kuliah.*, dosen.*, mata_kuliah.*')
            ->join('dosen', 'dosen.NIP = perbaikan_mata_kuliah.NIP')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = perbaikan_mata_kuliah.kode_mk')
            ->get()
            ->getResult();
    }

    public function submitTambah($saveData)  
    {
        return $this->db->table($this->table)
            ->insert($saveData);
    }

    public function updateExcel($saveData)  
    {
        return $this->db->table($this->table)
            ->replace($saveData);
    }

    public function editPerbaikanMataKuliah($id)
    {
        return $this->db->table($this->table)
            ->select('perbaikan_mata_kuliah.*, dosen.*, mata_kuliah.*')
            ->join('dosen', 'dosen.NIP = perbaikan_mata_kuliah.NIP')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = perbaikan_mata_kuliah.kode_mk')
            ->where('perbaikan_mata_kuliah.id', $id)
            ->get()
            ->getResult();
    }

    public function submitEdit($saveData, $idEdit)
    {
        return $this->db->table($this->table)
            ->where('id', $idEdit)
            ->update($saveData);
    }

    public function updatePerbaikanMataKuliah($saveData)  
    {
        return $this->db->table($this->table)
            ->replace($saveData);
    }

    public function hapus($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->delete();
    }
}

?>
