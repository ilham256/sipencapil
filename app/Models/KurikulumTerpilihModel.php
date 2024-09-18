<?php

namespace App\Models;

use CodeIgniter\Model;

class KurikulumTerpilihModel extends Model
{
    protected $table = 'kurikulum_terpilih'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['kode_kurikulum']; // Sesuaikan dengan kolom tabel Anda

    public function get()
    {
        return $this->findAll();
    }


    public function submitEdit($saveData, $idEdit)
    {
        return $this->update($idEdit, $saveData);
    }

    public function updatekuriKulumTerpilih($saveData)
    {
        return $this->replace($saveData);
    }

}
?>
