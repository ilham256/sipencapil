<?php

namespace App\Models;

use CodeIgniter\Model;

class RelevansiPpmModel extends Model 
{
    protected $table = 'relevansi_ppm';
    protected $primaryKey = 'id';
    protected $useTimestamps = false; // Sesuaikan dengan kebutuhan

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getRelevansiPpm()  
    {
        return $this->db->table($this->table)
            ->get()
            ->getResult();
    }

    public function getCpl()   
    {
        return $this->db->table('cpl_langsung')
            ->get()
            ->getResult();
    }

    public function updateExcelRelevansiPpm($saveData)  
    {
        return $this->db->table($this->table)
            ->replace($saveData);
    }

    public function updateExcelNilaiRelevansiPpm($saveData)  
    {
        return $this->db->table('nilai_relevansi_ppm')
            ->replace($saveData);
    }

    public function updateExcelNilaiRelevansiPpmCpl($saveData)  
    {
        return $this->db->table('nilai_relevansi_ppm_cpl')
            ->replace($saveData);
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
