<?php

namespace App\Models;

use CodeIgniter\Model;

class FormulaDeskriptorModel extends Model
{
    protected $table = 'deskriptor';

    public function getDeskriptorBA()  
    {
        return $this->db->table($this->table)
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getDeskriptor()  
    {
        return $this->db->table('cpl_rumus_deskriptor')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getDataDeskriptor($id)  
    {
        return $this->db->table($this->table)
            ->select('*')
            ->where('id_deskriptor', $id)
            ->get()
            ->getResult();
    }

    public function getCplRumusDeskriptor($id)  
    {
        return $this->db->table('cpl_rumus_deskriptor')
            ->select('*')
            ->where('id_cpl_rumus_deskriptor', $id)
            ->get()
            ->getResult();
    }

    public function getMatakuliahHasCpmk()  
    {
        return $this->db->table('matakuliah_has_cpmk')
            ->select('*')
            ->join('cpmk_langsung', 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk')
            ->orderBy('id_matakuliah_has_cpmk', 'asc')
            ->get()
            ->getResult();
    }

    public function getMatakuliahHasCpmkKurikulumTerpilih($id)  
    {
        return $this->db->table('matakuliah_has_cpmk')
            ->select('*')
            ->join('cpmk_langsung', 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk')
            ->orderBy('id_matakuliah_has_cpmk', 'asc')
            ->where('mata_kuliah.kode_kurikulum', $id)
            ->get()
            ->getResult();
    }

    public function getDeskriptorRumusCpmk()  
    {
        return $this->db->table('deskriptor_rumus_cpmk')
            ->select('*')
            ->join('deskriptor', 'deskriptor.id_deskriptor = deskriptor_rumus_cpmk.id_deskriptor')
            ->join('matakuliah_has_cpmk', 'matakuliah_has_cpmk.id_matakuliah_has_cpmk = deskriptor_rumus_cpmk.id_matakuliah_has_cpmk')
            ->join('cpmk_langsung', 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk')
            ->get()
            ->getResult();
    }

    public function getDeskriptorRumusCpmkKurikulumTerpilih($id)  
    {
        return $this->db->table('deskriptor_rumus_cpmk')
            ->select('*')
            ->join('matakuliah_has_cpmk', 'matakuliah_has_cpmk.id_matakuliah_has_cpmk = deskriptor_rumus_cpmk.id_matakuliah_has_cpmk')
            ->join('cpmk_langsung', 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk')
            ->where('mata_kuliah.kode_kurikulum', $id)
            ->get()
            ->getResult();
    }

     public function getDeskriptorRumusCpmkAll()  
    {
        return $this->db->table('deskriptor_rumus_cpmk')
            ->select('*')
            ->join('matakuliah_has_cpmk', 'matakuliah_has_cpmk.id_matakuliah_has_cpmk = deskriptor_rumus_cpmk.id_matakuliah_has_cpmk')
            ->join('cpmk_langsung', 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk')
            ->get()
            ->getResult();
    }

    public function editDeskriptor($id)  
    { 
        return $this->db->table($this->table)
            ->select('*')
            ->where('id_deskriptor', $id)
            ->get()
            ->getResult();
    }

    public function editFormulaDeskriptor($id)  
    {
        return $this->db->table('deskriptor_rumus_cpmk')
            ->select('*')
            ->join('matakuliah_has_cpmk', 'matakuliah_has_cpmk.id_matakuliah_has_cpmk = deskriptor_rumus_cpmk.id_matakuliah_has_cpmk')
            ->join('cpmk_langsung', 'cpmk_langsung.id_cpmk_langsung = matakuliah_has_cpmk.id_cpmk_langsung')
            ->join('mata_kuliah', 'mata_kuliah.kode_mk = matakuliah_has_cpmk.kode_mk')
            ->where('id_deskriptor_rumus_cpmk', $id)
            ->orderBy('id_deskriptor_rumus_cpmk', 'asc')
            ->get()
            ->getResult();
    }

    public function submitTambahDeskriptor($save_data)  
    {
        $this->db->table($this->table)
            ->insert($save_data);
        return true;
    }

    public function submitEditDeskriptor($save_data, $id_edit) 
    {
        $this->db->table($this->table)
            ->where('id_deskriptor', $id_edit)
            ->update($save_data);
        return true;
    }

    public function submitTambahFormula($save_data)  
    {
        $this->db->table('deskriptor_rumus_cpmk')
            ->insert($save_data);
        return true; 
    }

    public function submitEditFormulaDeskriptor($save_data, $id_edit) 
    {
        $this->db->table('deskriptor_rumus_cpmk')
            ->where('id_deskriptor_rumus_cpmk', $id_edit)
            ->update($save_data);
        return true;
    }

    public function hapusFormulaDeskriptor($id)
    {
        $this->db->table('deskriptor_rumus_cpmk')
            ->where('id_deskriptor_rumus_cpmk', $id)
            ->delete();
        return true;
    }

    public function hapusDeskriptor($id)
    {
        $this->db->table($this->table)
            ->where('id_deskriptor', $id)
            ->delete();
        return true;
    }
}
?>
