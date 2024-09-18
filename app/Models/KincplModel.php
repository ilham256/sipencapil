<?php

namespace App\Models;

use CodeIgniter\Model;

class KincplModel extends Model
{
    protected $tableSemester = 'semester';
    protected $tableCplLangsung = 'cpl_langsung';

    public function getSemester()  
    {
        return $this->db->table($this->tableSemester)
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getCpl()  
    {
        return $this->db->table($this->tableCplLangsung)
            ->select('*')
            ->get()
            ->getResult();
    }
}
?>
