<?php

namespace App\Models;

use CodeIgniter\Model;

class KinumumModel extends Model
{
    protected $tableKinerjaCplCpmk = 'kinerja_cpl_cpmk';
    protected $tableCplLangsung = 'cpl_langsung';
    protected $tableCplRumusDeskriptor = 'cpl_rumus_deskriptor';
    protected $tableDeskriptorRumusCpmk = 'deskriptor_rumus_cpmk';
    protected $tableMatakuliahHasCpmk = 'matakuliah_has_cpmk';
    protected $tableMataKuliah = 'mata_kuliah';
    protected $tableMahasiswa = 'mahasiswa';
    protected $tableNilaiCpmk = 'nilai_cpmk';

    public function getKinumum()  
    {
        return $this->db->table($this->tableKinerjaCplCpmk)
            ->select('*')
            ->get()
            ->getResult();
    } 

    public function submitEdit($saveData, $idEdit)
    {
        return $this->db->table($this->tableKinerjaCplCpmk)
            ->where('id', '1')
            ->update($saveData);
    }

    // Codingan Baru

    public function getCpl($id)  
    {
        return $this->db->table($this->tableCplLangsung)
            ->select('*')
            ->where('cpl_langsung.kode_kurikulum', $id)
            ->get()
            ->getResult();
    }

    public function getCplRumusDeskriptor($id)  
    {
        return $this->db->table($this->tableCplRumusDeskriptor)
            ->select('*')
            ->join('cpl_langsung', 'cpl_langsung.id_cpl_langsung = cpl_rumus_deskriptor.id_cpl_langsung')
            ->where('cpl_langsung.kode_kurikulum', $id)
            ->get()
            ->getResult();
    } 

    public function getDeskriptorRumusCpmk()  
    {
        return $this->db->table($this->tableDeskriptorRumusCpmk)
            ->select('*')
            ->join($this->tableMatakuliahHasCpmk, 'deskriptor_rumus_cpmk.id_matakuliah_has_cpmk = matakuliah_has_cpmk.id_matakuliah_has_cpmk')
            ->join($this->tableMataKuliah, 'matakuliah_has_cpmk.kode_mk = mata_kuliah.kode_mk')
            ->get()
            ->getResult();
    }

    public function getDeskriptorRumusCpmkKurikulumTerpilih($id)  
    {
        return $this->db->table($this->tableDeskriptorRumusCpmk)
            ->select('*')
            ->join($this->tableMatakuliahHasCpmk, 'deskriptor_rumus_cpmk.id_matakuliah_has_cpmk = matakuliah_has_cpmk.id_matakuliah_has_cpmk')
            ->join($this->tableMataKuliah, 'matakuliah_has_cpmk.kode_mk = mata_kuliah.kode_mk')
            ->where('mata_kuliah.kode_kurikulum', $id)
            ->get()
            ->getResult();
    } 

    public function getMahasiswaTahun($tahun)  
    {
        $status = ['Aktif', 'Lulus'];
        return $this->db->table($this->tableMahasiswa)
            ->select('*')
            ->where('tahun_masuk', $tahun)
            ->whereIn('StatusAkademik', $status)
            ->get()
            ->getResult();
    }

    public function getMahasiswaTahuns($tahun)  
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('*')
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getListTahunAngkatan()
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('tahun_masuk')
            ->distinct()
            ->orderBy('tahun_masuk', 'DESC')
            ->get()
            ->getResult();
    }

    public function getDataMahasiswa($nim)  
    {
        return $this->db->table($this->tableMahasiswa)
            ->select('*')
            ->where('nim', $nim)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmk()  
    {
        return $this->db->table($this->tableNilaiCpmk)
            ->select('*')
            ->get()
            ->getResult();
    }

    public function getNilaiCpmkAngkatan($tahun)  
    {
        return $this->db->table($this->tableNilaiCpmk)
            ->select('*')
            ->join($this->tableMahasiswa, 'nilai_cpmk.nim = mahasiswa.nim')
            ->where('tahun_masuk', $tahun)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmkSelect($id)  
    {
        return $this->db->table($this->tableNilaiCpmk)
            ->select('*')
            ->where('id_nilai', $id)
            ->get()
            ->getResult();
    }

    public function getNilaiCpmkMahasiswa($id)  
    {
        return $this->db->table($this->tableNilaiCpmk)
            ->select('*')
            ->join($this->tableMatakuliahHasCpmk, 'nilai_cpmk.id_matakuliah_has_cpmk = matakuliah_has_cpmk.id_matakuliah_has_cpmk')
            ->join($this->tableMataKuliah, 'matakuliah_has_cpmk.kode_mk = mata_kuliah.kode_mk')
            ->where('nim', $id)
            ->get()
            ->getResult();
    }

    public function getMatakuliahHasCpmk()  
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->select('*')
            ->join($this->tableMataKuliah, 'matakuliah_has_cpmk.kode_mk = mata_kuliah.kode_mk')
            ->get()
            ->getResult();
    }

    public function getMatakuliahHasCpmkKurikulum($kurikulum)  
    {
        return $this->db->table($this->tableMatakuliahHasCpmk)
            ->select('*')
            ->join($this->tableMataKuliah, 'matakuliah_has_cpmk.kode_mk = mata_kuliah.kode_mk')
            ->where('kode_kurikulum', $kurikulum)
            ->get()
            ->getResult();
    }

    public function countCpmkMahasiswa($kode_mk_cpmk)  
    {
        return $this->db->table($this->tableNilaiCpmk)
            ->where('id_matakuliah_has_cpmk', $kode_mk_cpmk)
            ->countAllResults();
    }
}

?>
