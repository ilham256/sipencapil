<?php

namespace App\Models;

use CodeIgniter\Model;

class KurikulumModel extends Model
{
    protected $table = 'kurikulum'; // Nama tabel
    protected $primaryKey = 'kode_kurikulum'; // Primary key
    protected $allowedFields = ['kode_kurikulum', 'nama', 'tahun','keterangan',]; // Sesuaikan dengan kolom tabel Anda

    public function get()
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

    public function edit($id)
    {
        return $this->where('nim', $id)->findAll();
    }

    public function submitEdit($saveData, $idEdit)
    {
        return $this->update($idEdit, $saveData);
    }

    public function updateKurikulum($saveData)
    {
        return $this->replace($saveData);
    }

    public function hapus($id)
    {
        return $this->where('kode_kurikulum', $id)->delete();
    }
}
?>
