<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model 
{
    protected $table = 'dosen'; // Nama tabel
    protected $primaryKey = 'NIP'; // Primary key
    protected $tableUser = 'user';
    protected $allowedFields = ['NIP', 'nama_dosen', 'password']; // Sesuaikan dengan kolom tabel Anda

    public function getDosen()
    {
        return $this->findAll();
    }

    public function submitTambah($KL)
    {
        //dd($saveData);

        return $this->insert($KL);
        return true;
    }

    public function updateExcel($saveData)
    {
        return $this->replace($saveData);
    }

    public function editDosen($id)
    {
        return $this->where('nim', $id)->findAll();
    }

    public function submitEdit($saveData, $idEdit)
    {
        return $this->update($idEdit, $saveData);
    }

    public function updateDosen($saveData)
    {
        return $this->replace($saveData);
    }

    public function updateUserDosen($saveDataUser)  
    {
        return $this->db->table($this->tableUser)
            ->replace($saveDataUser);
    }

    public function hapus($id)
    {
        return $this->where('NIP', $id)
                    ->delete();
    }
}
?>
