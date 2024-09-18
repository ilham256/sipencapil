<?php

namespace App\Controllers;

use App\Models\CpltlangModel;
use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;
use App\Models\KurikulumTerpilihModel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Cpltlang extends BaseController {

    protected $cpltlangModel;
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $kurikulumTerpilihModel;

    public function __construct() {
        $this->cpltlangModel = new CpltlangModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kurikulumTerpilihModel = new KurikulumTerpilihModel();

        $session = \Config\Services::session();
        if (!$session->get('loggedin') || $session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index() {
                // Tambahkan baris ini untuk meningkatkan limit memori
        
        $data = [
            'breadcrumbs' => 'cpltlang',
            'content' => 'vw_cpltlang',
            'cpl' => $this->cpltlangModel->getCpl(),
            'simpanan_tahun' => " - Pilih Tahun - ",
            't_simpanan_tahun' => " ",
            'datas' => [],
            'data_mahasiswa' => [],
        ];
        $data['status_list_nilai'] = "sembunyikan";
        $kurikulum_terpilih = $this->kurikulumTerpilihModel->get();
        //dd($kurikulum_terpilih[0]->kode_kurikulum);
        $data['kurikulum_terpilih'] = $kurikulum_terpilih[0]['kode_kurikulum'];   
        
        $data['tahun_masuk'] = $this->mahasiswaModel->gettahunmasuk();


        if ($this->request->getPost('pilih')) {
            $data_tahun_masuk = $this->request->getPost('tahun_masuk');

            $data['datas'] = $this->cpltlangModel->getCpltlang($data_tahun_masuk);
            $data['data_mahasiswa'] = $this->cpltlangModel->getMahasiswa($data_tahun_masuk);

            $data_tahun = $data_tahun_masuk + 1;
            $data['simpanan_tahun'] = $data_tahun_masuk;
            $data['t_simpanan_tahun'] = "/" . $data_tahun;
            $data['status_list_nilai'] = "tampilkan";
        }
        //dd($data);
        return view('vw_template', $data);
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
            $arr['datas_cpl'] = $this->cpltlang_model->getcpl();

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

                        $data_cek =  $this->cpltlang_model->cekcpl($key);

                        if (empty($data_cek)) {
                            $save_data = array(
                                "id_nilai_cpl_tak_langsung"=>"Data_cpltlang_Kosong",
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

                        $insert = $this->cpltlang_model->updateexcel($save_data);
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
        $arr['breadcrumbs'] = 'cpltlang';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan5';
        $this->load->view('vw_template', $arr);


    }


}
 