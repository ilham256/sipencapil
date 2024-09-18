<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $tableMahasiswa = 'mahasiswa';
    protected $tableUser = 'user';
    protected $allowedFields = ['id', 'username', 'password']; 

    public function getMahasiswa()  
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('*')
            ->orderBy('tahun_masuk', 'ASC')
            ->get()
            ->getResult();
    }

    public function getMahasiswaKurikulum($nim) 
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('kode_kurikulum')
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getMahasiswaInfo($nim) 
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('*')
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getMahasiswaTahunMasuk($tahun)  
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('*')
            ->where('tahun_masuk', $tahun)
            ->orderBy('tahun_masuk', 'ASC')
            ->get()
            ->getResult();
    }

    public function getTahunMasuk()  
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('tahun_masuk')
            ->orderBy('tahun_masuk', 'ASC')
            ->distinct()
            ->get()
            ->getResult();
    } 

    public function getTahunMasukMin()  
    {
        return $this->db->table($this->tableMahasiswa)
            ->selectMin('tahun_masuk')
            ->get()
            ->getResult();
    }

    public function getTahunMasukMax()  
    {
        return $this->db->table($this->tableMahasiswa)
            ->selectMax('tahun_masuk')
            ->get()
            ->getResult();
    }

    public function submitTambah($saveData)  
    {
        return $this->db->table($this->tableMahasiswa)
            ->insert($saveData);
    }

    public function updateExcel($saveData)  
    {
        return $this->db->table($this->tableMahasiswa)
            ->replace($saveData);
    }

    public function editMahasiswa($id)
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('*')
            ->where('nim', $id)
            ->get()
            ->getResult();
    }

    public function submitEdit($saveData, $idEdit)
    {
        return $this->db->table($this->tableMahasiswa)
            ->where('nim', $idEdit)
            ->update($saveData);
    }

    public function updateMahasiswa($saveData)  
    {
        return $this->db->table($this->tableMahasiswa)
            ->replace($saveData);
    }

    public function hapus($id)
    {
        return $this->db->table($this->tableMahasiswa)
            ->where('nim', $id)
            ->delete();
    }

    public function cekUserMahasiswa($data)  
    {
        return $this->db->table($this->tableUser)
            ->select('id')
            ->where('id', $data)
            ->get()
            ->getResult();
    }

    public function updateUserMahasiswa($saveDataUser)  
    {
        return $this->db->table($this->tableUser)
            ->replace($saveDataUser);
    }

    public function submitResetPasswordMahasiswa($save_data, $id_edit)  
    {
        return $this->db->table($this->tableUser)
            ->where('id', $id_edit)
            ->update($save_data);
    }
    
}

?>
