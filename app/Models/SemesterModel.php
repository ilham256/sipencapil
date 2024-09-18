<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model 
{
    protected $table = 'semester'; // Sesuaikan dengan nama tabel yang benar

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getSemesters($order = 'asc')
    {
        return $this->db->table($this->table)
            ->orderBy('id_semester', $order)
            ->get()
            ->getResult();
    }
}

?>
