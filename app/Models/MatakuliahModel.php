<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $tableMataKuliah = 'mata_kuliah';
    protected $tableMatakuliahHasCpmk = 'matakuliah_has_cpmk';
    protected $tableSemester = 'semester';
    protected $tableCpmkLangsung = 'cpmk_langsung';

    public function getMatakuliah()  
    {
        return $this->db->table($this->tableMataKuliah)
            ->select('*')
            ->join($this->tableSemester, 'semester.id_semester = mata_kuliah.id_semester')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResult();
    }

    public function getMatakuliahKurikulum($id)  
    {
        return $this->db->table($this->tableMataKuliah)
            ->select('*')
            ->where('kode_kurikulum', $id)
            ->get()
            ->getResult();
    }

    public function getMatakuliahHasCpmkByMk($id)  
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->select('*')
            ->where('kode_mk', $id)
            ->join($this->tableCpmkLangsung, 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->orderBy('id_matakuliah_has_cpmk', 'ASC')
            ->get()
            ->getResult();
    }

    public function getMkMatakuliahHasCpmk($id)  
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->select('kode_mk')
            ->where('id_matakuliah_has_cpmk', $id)
            ->get()
            ->getResult();
    }

    // Fungsi untuk memeriksa apakah primary key sudah ada
    public function cekIdMatakuliahHasCpmk($id)
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)  // Gunakan tabel tambahan
            ->select('id_matakuliah_has_cpmk')
            ->where('id_matakuliah_has_cpmk', $id)
            ->get()
            ->getRow() !== null;
    }

    public function getMkMatakuliahHasCpmkAll()  
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->select('*')
            ->join($this->tableCpmkLangsung, 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->get()
            ->getResult();
    }

    public function getSelectMatakuliah($semester,$kurikulum)
    {
        return $this->db->table($this->tableMataKuliah)
            ->select('*')
            ->where('id_semester', $semester)
            ->where('kode_kurikulum', $kurikulum)
            ->get()
            ->getResult();
    }

    public function getSemester()  
    {
        return $this->db->table($this->tableSemester)
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getCpmk()  
    {
        return $this->db->table($this->tableCpmkLangsung)
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getRps($id)  
    {
        return $this->db->table($this->tableMataKuliah)
            ->select('rps')
            ->where('kode_mk', $id)
            ->get()
            ->getResult();
    }

    public function submitTambah($saveData)  
    {
        return $this->db->table($this->tableMataKuliah)
            ->insert($saveData);
    }

    public function editMatakuliah($id)
    {
        return $this->db->table($this->tableMataKuliah)
            ->where('kode_mk', $id)
            ->get()
            ->getResult();
    }

    public function editMatakuliahHasCpmk($id)
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->where('id_matakuliah_has_cpmk', $id)
            ->get()
            ->getResult();
    }

    public function submitEdit($saveData, $idEdit)
    {
        return $this->db->table($this->tableMataKuliah)
            ->where('kode_mk', $idEdit)
            ->update($saveData);
    }

    public function hapus($id)
    {
        return $this->db->table($this->tableMataKuliah)
            ->where('kode_mk', $id)
            ->delete();
    }

    public function hapusMatakuliahHasCpmk($id)
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->where('id_matakuliah_has_cpmk', $id)
            ->delete();
    }

    public function getNamaMk($dataMataKuliah)  
    {
        return $this->db->table($this->tableMataKuliah)
            ->select('*')
            ->where('kode_mk', $dataMataKuliah)
            ->get()
            ->getResult();
    }

    public function submitTambahMatakuliahHasCpmk($saveData)  
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->insert($saveData);
    }

    public function submitEditMatakuliahHasCpmk($saveData, $idEdit)
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->where('id_matakuliah_has_cpmk', $idEdit)
            ->update($saveData);
    }
}

?>
