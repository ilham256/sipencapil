<?php

namespace App\Models;

use CodeIgniter\Model;

class KatkinModel extends Model
{
    protected $table = 'kinerja_cpl_cpmk';

    public function getKatkin()  
    {
        return $this->db->table($this->table)
            ->select('*')
            ->get()
            ->getResult();
    }

    public function submitEdit($save_data, $id)
    {
        $this->db->table($this->table)
            ->where('id', $id)
            ->update($save_data);
        return true;
    }
}
?>
