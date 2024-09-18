<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model 
{
    protected $table = 'user'; // Sesuaikan dengan nama tabel yang benar

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getUser()
    {
        return $this->db->table($this->table)
            ->orderBy('level', 'ASC')
            ->get()
            ->getResult();
    }

    public function updatePassword($save_data, $id)
    {
        $this->db->table($this->table)
            ->where('id', $id)
            ->update($save_data);
        return true;
    }

    public function getAdmin()
    {
        return $this->db->table($this->table)
            ->where('level', 0)
            ->get()
            ->getResult();
    }

    public function getAdminSelect($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->get()
            ->getResult();
    }

    public function getUserSelect($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->get()
            ->getResult();
    }

    public function submitTambahAdmin($save_data)
    {
        $this->db->table($this->table)->insert($save_data);
        return true;
    }

    public function getDosen()
    {
        return $this->db->table($this->table)
            ->where('level', 1)
            ->get()
            ->getResult();
    }

    public function getDosenSelect($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->get()
            ->getResult();
    }

    public function submitTambahDosen($save_data)
    {
        $this->db->table($this->table)->insert($save_data);
        return true;
    }

    public function getMahasiswa()
    {
        return $this->db->table($this->table)
            ->where('level', 2)
            ->get()
            ->getResult();
    }

    public function getMahasiswaSelect($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->get()
            ->getResult();
    }

    public function submitTambahMahasiswa($save_data)
    {
        $this->db->table($this->table)->insert($save_data);
        return true;
    }

    public function hapusUser($id)
    {
        $this->db->table($this->table)
            ->where('id', $id)
            ->delete();
        return true;
    }
}

?>
