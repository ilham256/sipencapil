<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EfektivitasCplModel;
use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EfektivitasCpl extends Controller {

    protected $efektivitasCplModel;
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $session;

    public function __construct() {
        $this->efektivitasCplModel = new EfektivitasCplModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->session = \Config\Services::session();

        if (!$this->session->get('loggedin') || $this->session->get('level') != 0) {
            header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index() {
        $data = [
            'breadcrumbs' => 'efektivitas_cpl',
            'content' => 'vw_efektivitas_cpl',
            'datas' => $this->efektivitasCplModel->getRelevansiPpm()
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
            $arr['datas_cpl'] = $this->efektivitas_cpl_model->getcpl();;

            //Menyimpan Data Persheet
            for ($p=0; $p < $highestSheet; $p++) { 
                
                $sheet = $objPHPExcel->getSheet($p);

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Menyimpan Data Alumnus
                //$kode_mk = str_replace(":", "", $kode_mk_2 );
                // Menyimpan Nilai PPM (CPL)
                $row_cpl = $sheet->rangeToArray('D' . 2 . ':' . $highestColumn . 2,
                                                    NULL,
                                                    TRUE,
                                                    FALSE);
                $row_cpl_1 = array_reduce($row_cpl, 'array_merge', array());
                $row_cpl_2 = str_replace("CMPK", "CPMK", $row_cpl_1);
                $row_nilai_cpl = str_replace(" ", "_", $row_cpl_2);

                $i = 0;
                 foreach ($row_nilai_cpl as $key) {
                     # code...
                     
                    for ($row = 3; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $rowNilai = $sheet->rangeToArray('D' . $row . ':' . $highestColumn . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        //Sesuaikan sama nama kolom tabel di database 

                        $data_cek =  $this->efektivitas_cpl_model->cekcpl($key);

                        if (empty($data_cek)) {
                            $save_data = array(
                                "id"=>"Data_efektivitas_CPL_Kosong",
                                "nim"=> 0,
                                "id_cpl_langsung"=> 0,
                                "nilai"=>  0
                            );
                            } 
                        elseif ($rowData[0][0] == NULL) {
                            $save_data = array(
                                "id"=>"Data_Kosong",
                                "nim"=> 0,
                                "id_cpl_langsung"=> 0,
                                "nilai"=>  0

                            );
                            } 
                        else {                            
                             $save_data = array(                            
                                "id"=> str_replace(" ","_",$rowData[0][1]).'_'.$key,
                                "nim"=> $rowData[0][1],
                                "id_cpl_langsung"=> $key,
                                "nilai"=>  $rowNilai[0][0+$i]

                            );                         
                            }

                        $masukan = $save_data;
                        //sesuaikan nama dengan nama tabel
                         
                        array_push($arr['datas'],$masukan);

                        $insert = $this->efektivitas_cpl_model->updateexcelnilaiefektivitascpl($save_data);
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
        $arr['breadcrumbs'] = 'relevansi_ppm';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan4';
        $this->load->view('vw_template', $arr);


    }

}