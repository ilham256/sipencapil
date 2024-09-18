<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class CplTersimpan extends BaseController 
{
    protected $cplTersimpanModel;
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $katkinModel;
    protected $kinumumModel;

    public function __construct()
    {
        $this->cplTersimpanModel = new \App\Models\CplTersimpanModel();
        $this->matakuliahModel = new \App\Models\MatakuliahModel();
        $this->mahasiswaModel = new \App\Models\MahasiswaModel();
        $this->katkinModel = new \App\Models\KatkinModel();
        $this->kinumumModel = new \App\Models\KinumumModel();

        if (session()->get('loggedin') != true || session()->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {   
        ini_set('memory_limit', '1G');
        $data['breadcrumbs'] = 'cpl_tersimpan';
        $data['content'] = 'vw_cpl_tersimpan';

        $data['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();
        $data['cpl'] = $this->cplTersimpanModel->getCpl();
        $data['simpanan_tahun'] = " - Pilih Tahun - ";
        $data['t_simpanan_tahun'] = " ";

        $data['datas'] = $this->cplTersimpanModel->getCplTersimpanAll();
        $data['data_mahasiswa'] = $this->cplTersimpanModel->getMahasiswaAll();

        if ($this->request->getPost('pilih')) {
            $data_tahun_masuk = $this->request->getPost('tahun_masuk'); 

            $data['datas'] = $this->cplTersimpanModel->getCplTersimpan($data_tahun_masuk);
            $data['data_mahasiswa'] = $this->cplTersimpanModel->getMahasiswa($data_tahun_masuk);

            $data_tahun = $data_tahun_masuk + 1;
            $data['simpanan_tahun'] = $data_tahun_masuk;
            $data['t_simpanan_tahun'] = "/" . $data_tahun;
        }

        return view('vw_template', $data);
    }

        public function tambah() 
    {
        $arr['breadcrumbs'] = 'cpl_tersimpan';
        $arr['content'] = 'cpl_tersimpan/tambah';

        $arr['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();

        $simpan_tahun = $this->mahasiswaModel->getTahunMasukMin();

        $arr['data_cpl'] = $this->kinumumModel->getCpl();

        $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor();
        $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk();
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

        if ($this->request->getPost('proses')) {
            $tahun = $this->request->getPost('tahun'); 
            $arr['simpanan_tahun'] = $tahun;
            $arr['t_simpanan_tahun'] = ((int)$tahun) + 1;
        }

        $nilai_std_max = [];
        $nilai_std_min = [];
        $nilai_cpl_average = []; 
        $nilai_cpl_mahasiswa = [];

        $simpan = [];

        $mahasiswa_2 = $this->kinumumModel->getMahasiswaTahun($tahun);
        $mahasiswa = [];

        foreach ($mahasiswa_2 as $key) { 
            $data_m = [
                "Nim" => $key->nim,
                "Nama" => $key->nama,
                "SemesterMahasiswa" => $key->SemesterMahasiswa,
                "StatusAkademik" => $key->StatusAkademik,
                "tahun" => $key->tahun_masuk
            ];
            $mahasiswa[] = $data_m;
        }
        $arr['data_mahasiswa'] = $mahasiswa;

        $data_nilai_cpl = [];
        foreach ($arr['data_cpl'] as $key_0) {
            foreach ($arr['data_mahasiswa'] as $key) {
                $n = 0;
                foreach ($nilai_cpmk as $key_2) {
                    if ($key["Nim"] == $key_2->nim) {
                        $n_1 = 0;
                        foreach ($rumus_cpl as $key_4) {
                            if ($key_0->id_cpl_langsung == $key_4->id_cpl_langsung) {
                                foreach ($rumus_deskriptor as $key_3) {
                                    if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
                                        if ($key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
                                            $n_1 += $key_4->persentasi * $key_2->nilai_langsung * $key_3->persentasi;
                                        }
                                    }
                                }
                            }
                        }
                        $n += $n_1;
                    }
                }

                $save_data = [
                    'nim' => $key["Nim"],
                    'nama_mahasiswa' => $key["Nama"],
                    'id_cpl_langsung' => $key_0->id_cpl_langsung,  
                    'nilai_cpl' => $n,         
                ];
                $data_nilai_cpl[] = $save_data;
            }           
        }

        $target = $this->katkinModel->getKatkin();
        $arr['target'] = $target[0]->nilai_target_pencapaian_cpl;
        $arr['datas'] = $data_nilai_cpl;

        return view('vw_template', $arr);
    }

    public function simpan() 
    {
        $arr['breadcrumbs'] = 'cpl_tersimpan';
        $arr['content'] = 'vw_data_berhasil_disimpan';

        $arr['tahun_masuk'] = $this->mahasiswaModel->getTahunMasuk();

        $simpan_tahun = $this->mahasiswaModel->getTahunMasukMin();

        $arr['data_cpl'] = $this->kinumumModel->getCpl();

        $rumus_cpl = $this->kinumumModel->getCplRumusDeskriptor();
        $rumus_deskriptor = $this->kinumumModel->getDeskriptorRumusCpmk();
        $nilai_cpmk = $this->kinumumModel->getNilaiCpmk();

        if ($this->request->getPost('simpan')) {
            $tahun = $this->request->getPost('tahun'); 
            $arr['simpanan_tahun'] = $tahun;
            $arr['t_simpanan_tahun'] = ((int)$tahun) + 1;
        }

        $nilai_std_max = [];
        $nilai_std_min = [];
        $nilai_cpl_average = []; 
        $nilai_cpl_mahasiswa = [];

        $simpan = [];

        $mahasiswa_2 = $this->kinumumModel->getMahasiswaTahun($tahun);
        $mahasiswa = [];

        foreach ($mahasiswa_2 as $key) { 
            $data_m = [
                "Nim" => $key->nim,
                "Nama" => $key->nama,
                "SemesterMahasiswa" => $key->SemesterMahasiswa,
                "StatusAkademik" => $key->StatusAkademik,
                "tahun" => $key->tahun_masuk
            ];
            $mahasiswa[] = $data_m;
        }
        $arr['data_mahasiswa'] = $mahasiswa;

        $data_nilai_cpl = [];
        foreach ($arr['data_cpl'] as $key_0) {
            foreach ($arr['data_mahasiswa'] as $key) {
                $n = 0;
                foreach ($nilai_cpmk as $key_2) {
                    if ($key["Nim"] == $key_2->nim) {
                        $n_1 = 0;
                        foreach ($rumus_cpl as $key_4) {
                            if ($key_0->id_cpl_langsung == $key_4->id_cpl_langsung) {
                                foreach ($rumus_deskriptor as $key_3) {
                                    if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
                                        if ($key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
                                            $n_1 += $key_4->persentasi * $key_2->nilai_langsung * $key_3->persentasi;
                                        }
                                    }
                                }
                            }
                        }
                        $n += $n_1;
                    }
                }

                $save_data = [
                    'nim' => $key["Nim"],
                    'nama_mahasiswa' => $key["Nama"],
                    'id_cpl_langsung' => $key_0->id_cpl_langsung,  
                    'nilai_cpl' => $n,         
                ];
                $save = [                            
                    "id_nilai_cpl_tersimpan" => $key["Nim"] . '_' . $key_0->id_cpl_langsung,
                    "nim" => $key["Nim"],
                    "id_cpl_langsung" => $key_0->id_cpl_langsung,
                    "nilai" => $n
                ];
                $this->cplTersimpanModel->updateExcel($save);
                $data_nilai_cpl[] = $save_data;
            }           
        }

        $target = $this->katkinModel->getKatkin();
        $arr['target'] = $target[0]->nilai_target_pencapaian_cpl;
        $arr['datas'] = $data_nilai_cpl;

        return view('vw_template', $arr);
    }

    public function import(){
    //echo "dkf";
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   // echo '<pre>';  var_dump($_FILES); echo '</pre>'; 
        if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
 
            $arr_file = explode('.', $_FILES['file']['name']);
            //echo '<pre>';  var_dump($arr_file); echo '</pre>'; 
            $extension = end($arr_file);
            if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else { 
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
            $objPHPExcel = $reader->load($_FILES['file']['tmp_name']);
            //$sheetData = $spreadsheet->getActiveSheet()->toArray();
            //$sheetData2 = $spreadsheet->getSheet(2)->toArray();
            $highestSheet = $objPHPExcel->getSheetCount();
            //echo "<pre>";
            //print_r($sheetData2);
            //echo '<pre>';  var_dump($highestSheet); echo '</pre>';

            //konfersi dari funsion uploads
            $arr['datas'] = [];
            $arr['datas_relevansi_ppm'] = [];
            $arr['datas_cpl'] = $this->cpl_tersimpan_model->get_cpl();

            //Menyimpan Data Persheet
            for ($p=0; $p < $highestSheet; $p++) { 
                
                $sheet = $objPHPExcel->getSheet($p);

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Menyimpan Data Alumnus
                //$kode_mk = str_replace(":", "", $kode_mk_2 );
                // Menyimpan Nilai PPM (CPL)
                $row_cpl = $sheet->rangeToArray('D' . 3 . ':' . $highestColumn . 3,
                                                    NULL,
                                                    TRUE,
                                                    FALSE);
                $row_cpl_1 = array_reduce($row_cpl, 'array_merge', array());
                $row_cpl_2 = str_replace("CMPK", "CPMK", $row_cpl_1);
                $row_nilai_cpl = str_replace(" ", "_", $row_cpl_2);

                $i = 0;
                 foreach ($row_nilai_cpl as $key) {
                     # code...
                     
                    for ($row = 4; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $rowNilai = $sheet->rangeToArray('D' . $row . ':' . $highestColumn . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        //Sesuaikan sama nama kolom tabel di database  

                        $data_cek =  $this->cpl_tersimpan_model->cek_cpl($key);

                        if (empty($data_cek)) {
                            $save_data = array(
                                "id_nilai_cpl_tak_langsung"=>"Data_cpl_tersimpan_Kosong",
                                "nim"=> 0,
                                "id_cpl_langsung"=> 0,
                                "nilai"=>  0
                            );
                            } 
                        elseif ($rowData[0][1] == NULL) {
                            $save_data = array(
                                "id_nilai_cpl_tak_langsung"=>"Data_Kosong",
                                "nim"=> 0,
                                "id_cpl_langsung"=> 0,
                                "nilai"=>  0

                            ); 
                            } 
                        else {                            
                             $save_data = array(                            
                                "id_nilai_cpl_tak_langsung"=> str_replace(" ","_",$rowData[0][1]).'_'.$key,
                                "nim"=> $rowData[0][1],
                                "id_cpl_langsung"=> $key,
                                "nilai"=>  $rowNilai[0][0+$i]

                            );                         
                            }

                        $masukan = $save_data; 
                        //sesuaikan nama dengan nama tabel
                         
                        array_push($arr['datas'],$masukan);

                        $insert = $this->cpl_tersimpan_model->update_excel($save_data);
                        //delete_files($media['file_path']);
                             
                        }

                        $i++;
                    }
                    
                    // Menyimpan Nilai PPM  
                }

        } else {
            //echo $_FILES['upload_file']['type'];
            echo '<pre>';  var_dump($_FILES['file']['type']); echo '</pre>';

        }
        //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
        $arr['breadcrumbs'] = 'cpl_tersimpan';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan5';
        $this->load->view('vw_template', $arr);


    }


}
 