<?php

namespace App\Models;

use CodeIgniter\Model;

class FormulaModel extends Model
{
    protected $table = 'cpl_langsung';

    public function getCpl()  
    {
        return $this->db->table($this->table)
            ->select('*')
            ->get()
            ->getResult();
    }


    public function getFormulaCpl($id)
    {
        return $this->db->table($this->table)
                        ->where('kode_kurikulum', $id)
                        ->get()
                        ->getResult();
    }

    public function getDataCpl($id)  
    {
        return $this->db->table($this->table)
            ->select('*')
            ->where('id_cpl_langsung', $id)
            ->get()
            ->getResult();
    }

    public function getAllCplRumusDeskriptor()  
    {
        return $this->db->table('cpl_rumus_deskriptor')
            ->select('*')
            ->join('deskriptor', 'deskriptor.id_deskriptor = cpl_rumus_deskriptor.id_deskriptor')
            ->get()
            ->getResult();
    }

    public function getCplRumusDeskriptor($id)
    {
        return $this->db->table('cpl_rumus_deskriptor')
                        ->select('*')
                        //->join('deskriptor', 'deskriptor.id_deskriptor = cpl_rumus_deskriptor.id_deskriptor')
                        ->join('cpl_langsung', 'cpl_langsung.id_cpl_langsung = cpl_rumus_deskriptor.id_cpl_langsung')
                        ->where('cpl_langsung.kode_kurikulum', $id)
                        ->get()
                        ->getResult();
    }

    public function editCpl($id)  
    {
        return $this->db->table($this->table)
            ->select('*')
            ->where('id_cpl_langsung', $id)
            ->get()
            ->getResult();
    }

    public function editCplRumusDeskriptor($id)  
    {
        return $this->db->table('cpl_rumus_deskriptor')
            ->select('*')
            ->join('cpl_langsung', 'cpl_langsung.id_cpl_langsung = cpl_rumus_deskriptor.id_cpl_langsung')
            ->join('deskriptor', 'deskriptor.id_deskriptor = cpl_rumus_deskriptor.id_deskriptor')
            ->where('id_cpl_rumus_deskriptor', $id)
            ->get()
            ->getResult();
    }

    public function getDeskriptor()  
    {
        return $this->db->table('deskriptor')
            ->select('*')
            ->get()
            ->getResult();
    }

    public function submitTambahCpl($save_data)  
    {
        $this->db->table($this->table)
            ->insert($save_data);
        return true;
    }

    public function submitEditCpl($save_data, $id_edit) 
    {
        $this->db->table($this->table)
            ->where('id_cpl_langsung', $id_edit)
            ->update($save_data);
        return true;
    }

    public function submitTambahFormulaDeskriptor($save_data)  
    {
        $this->db->table('cpl_rumus_deskriptor')
            ->insert($save_data);
        return true; 
    }

    public function submitEditFormulaDeskriptor($save_data, $id_edit) 
    {
        $this->db->table('cpl_rumus_deskriptor')
            ->where('id_cpl_rumus_deskriptor', $id_edit)
            ->update($save_data);
        return true;
    }

    public function hapusFormulaDeskriptor($id)
    {
        $this->db->table('cpl_rumus_deskriptor')
            ->where('id_cpl_rumus_deskriptor', $id)
            ->delete();
        return true;
    }

    public function hapusCpl($id)
    {
        $this->db->table($this->table)
            ->where('id_cpl_langsung', $id)
            ->delete();
        return true;
    }
}
?>
