<?php

namespace App\Controllers;

use App\Models\RelevansiPpmModel;
use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class RelevansiPpm extends BaseController
{
    protected $relevansiPpmModel;
    protected $matakuliahModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->relevansiPpmModel = new RelevansiPpmModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();

        if (!session()->get('loggedin') || session()->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index()
    {
        $data = [
            'breadcrumbs' => 'relevansi_ppm',
            'content' => 'vw_relevansi_ppm',
            'datas' => $this->relevansiPpmModel->getRelevansiPpm(),
        ];

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
                $arr['datas_cpl'] = $this->relevansi_ppm_model->getcpl();;

                //Menyimpan Data Persheet
                for ($p=0; $p < $highestSheet; $p++) { 
                    
                    $sheet = $objPHPExcel->getSheet($p);

                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    // Menyimpan Data Alumnus
                    //$kode_mk = str_replace(":", "", $kode_mk_2 );
                    for ($row = 2; $row <= $highestRow; $row++){  
                    $row_relevansi_ppm = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row ,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);            
                        if ($row_relevansi_ppm[0][0] !== NULL) {
                        $save_data_ppm = array(
                                        "id_relevansi_ppm"=>str_replace(" ","_",$row_relevansi_ppm[0][3]).'_'.str_replace(" ","_",$row_relevansi_ppm[0][0]),
                                        "nama"=> $row_relevansi_ppm[0][0],
                                        "posisi"=> $row_relevansi_ppm[0][1],
                                        "jenis_kelamin"=> $row_relevansi_ppm[0][2],
                                        "tahun_lulusan"=> $row_relevansi_ppm[0][3],
                                        "nama_organisasi"=> $row_relevansi_ppm[0][5],
                                        "alamat"=> $row_relevansi_ppm[0][6],
                                        "hp"=> $row_relevansi_ppm[0][7],
                                        "email"=> $row_relevansi_ppm[0][8]);

                        array_push($arr['datas_relevansi_ppm'],$save_data_ppm);
                        $insert = $this->relevansi_ppm_model->updateexcelrelevansippm($save_data_ppm);

                        }
                    }
                    // Menyimpan Nilai PPM (CPL)
                    $row_cpl = $sheet->rangeToArray('K' . 1 . ':' . 'R' . 1,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                    $row_cpl_1 = array_reduce($row_cpl, 'array_merge', array());
                    $row_cpl_2 = str_replace("CMPK", "CPMK", $row_cpl_1);
                    $row_nilai_cpl = str_replace(" ", "_", $row_cpl_2);

                    $i = 0;
                     foreach ($row_nilai_cpl as $key) {
                         # code...
                         
                        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                            $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row,
                                                            NULL,
                                                            TRUE,
                                                            FALSE);
                            $rowNilai = $sheet->rangeToArray('K' . $row . ':' . 'R' . $row,
                                                            NULL,
                                                            TRUE,
                                                            FALSE);
                            //Sesuaikan sama nama kolom tabel di database 

                            $data_cek =  $this->relevansi_ppm_model->cekcpl($key);

                            if (empty($data_cek)) {
                                $save_data = array(
                                    "id"=>"Data_Relevansi_PPM_CPL_Kosong",
                                    "id_relevansi_ppm"=> 0,
                                    "id_cpl_langsung"=> 0,
                                    "nilai_relevansi_ppm_cpl"=>  0
                                );
                                } 
                            elseif ($rowData[0][0] == NULL) {
                                $save_data = array(
                                    "id"=>"Data_Kosong",
                                    "id_relevansi_ppm"=> 0,
                                    "id_cpl_langsung"=> 0,
                                    "nilai_relevansi_ppm_cpl"=>  0

                                );
                                } 
                            else {                            
                                 $save_data = array(                            
                                    "id"=>str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]).'_'.$key,
                                    "id_relevansi_ppm"=> str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]),
                                    "id_cpl_langsung"=> $key,
                                    "nilai_relevansi_ppm_cpl"=>  $rowNilai[0][0+$i]

                                );                         
                                }

                            $masukan = $save_data;
                            //sesuaikan nama dengan nama tabel
                             
                            array_push($arr['datas'],$masukan);
                            $insert = $this->relevansi_ppm_model->updateexcelnilairelevansippmcpl($save_data);
                            //delete_files($media['file_path']);
                                 
                            }

                            $i++;
                        }
                        
                        // Menyimpan Nilai PPM

                        $row_ppm = $sheet->rangeToArray('V' . 1 . ':' . 'Z' . 1,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $row_ppm_1 = array_reduce($row_ppm, 'array_merge', array());
                        $row_ppm_2 = str_replace("CMPK", "CPMK", $row_ppm_1);
                        $row_nilai_ppm = str_replace(" ", "_", $row_ppm_2);
                        
                        $i = 0;
                         foreach ($row_nilai_ppm as $key) {
                             # code...
                             
                            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                                $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row,
                                                                NULL,
                                                                TRUE,
                                                                FALSE);
                                $rowNilai = $sheet->rangeToArray('V' . $row . ':' . 'Z' . $row,
                                                                NULL,
                                                                TRUE,
                                                                FALSE);
                                //Sesuaikan sama nama kolom tabel di database 

                                $data_cek =  $this->relevansi_ppm_model->cekppm($key);

                                if (empty($data_cek)) {
                                    $save_data = array(
                                        "id"=>"Data_Relevansi_PPM_Kosong",
                                        "id_relevansi_ppm"=> 0,
                                        "id_ppm"=> 0,
                                        "nilai_relevansi_ppm"=>  0
                                    );
                                    } 
                                elseif ($rowData[0][0] == NULL) {
                                    $save_data = array(
                                        "id"=>"Data_Kosong",
                                        "id_relevansi_ppm"=> 0,
                                        "id_ppm"=> 0,
                                        "nilai_relevansi_ppm"=>  0

                                    );
                                    } 
                                else {                            
                                     $save_data = array(                            
                                        "id"=>str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]).'_'.$key,
                                        "id_relevansi_ppm"=> str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]),
                                        "id_ppm"=> $key,
                                        "nilai_relevansi_ppm"=>  $rowNilai[0][0+$i]

                                    );                         
                                    }

                                $masukan = $save_data;
                                //sesuaikan nama dengan nama tabel
                                 
                                array_push($arr['datas'],$masukan);
                                $insert = $this->relevansi_ppm_model->updateexcelnilairelevansippm($save_data);
                                //delete_files($media['file_path']);
                                     
                                }

                                $i++;
                            }

                }

            } else {
                //echo $_FILES['upload_file']['type'];
                echo '<pre>';  var_dump($_FILES['file']['type']); echo '</pre>';

            }
            //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
            $arr['breadcrumbs'] = 'relevansi_ppm';
            $arr['content'] = 'vw_data_nilai_berhasil_disimpan3';
            $this->load->view('vw_template', $arr);


    }

}