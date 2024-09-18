<?php

namespace App\Controllers;

use App\Models\mahasiswaModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Mahasiswa extends Controller {

    protected $mahasiswaModel;

    public function __construct() {
        $this->mahasiswaModel = new mahasiswaModel();
        $session = session();
        if (!$session->get('loggedin') || $session->get('level') != 0) {
           header('Location: ' . base_url('Auth/login'));
            exit(); 
        }
    }

    public function index() {
        $data['breadcrumbs'] = 'mahasiswa';
        $data['content'] = 'vw_mahasiswa';
        $data['datas'] = $this->mahasiswaModel->getMahasiswa();
        $data['jumlah_mahasiswa'] = count($data['datas']);
        echo view('vw_template', $data);
    }
 
    public function tambah() {
        $data['breadcrumbs'] = 'mahasiswa';
        $data['content'] = 'mahasiswa/tambah';
        echo view('vw_template', $data);
    }

    public function submitTambah() {
        $request = \Config\Services::request();

        if ($request->getPost('simpan')) {
            $tahun = $request->getPost('tahun');

            function curl($url) {
                $ch = curl_init();
                $headers = array(
                    'accept: text/plain',
                    'X-IPBAPI-TOKEN: Bearer 86f2760d-7293-36f4-833f-1d29aaace42e'
                );
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $output = curl_exec($ch);
                curl_close($ch);
                return $output;
            }

            $send = curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=" . $tahun);
            $data_mahasiswa = json_decode($send, TRUE);
            $masukan = [];

            foreach ($data_mahasiswa as $key) {
                $save_data = [
                    "nim" => $key["Nim"],
                    "nama" => $key["Nama"],
                    "SemesterMahasiswa" => $key["SemesterMahasiswa"],
                    "StatusAkademik" => $key["StatusAkademik"],
                    "tahun_masuk" => $tahun
                ];

                array_push($masukan, $save_data);
                $this->mahasiswaModel->updateMahasiswa($save_data);

                $cek_id = $this->mahasiswaModel->cekUserMahasiswa($key["Nim"]);
                if (empty($cek_id)) {
                    $save_data_user = [
                        'id' => $key["Nim"],
                        'username' => $key["Nim"],
                        'email' => '',
                        'password' => password_hash('admin', PASSWORD_DEFAULT),
                        'level' => 2,
                    ];
                    $this->mahasiswaModel->updateUserMahasiswa($save_data_user);
                }
            }

            $data['datas'] = $masukan;
            $data['datas_tahun'] = $tahun;
            $data['breadcrumbs'] = 'mahasiswa';
            $data['content'] = 'mahasiswa/vw_data_mahasiswa_berhasil_disimpan';
            echo view('vw_template', $data);
        }
    }

    public function exportExcel() {
        $data_mahasiswa = $this->mahasiswaModel->getMahasiswa();
        $data = [
            'title' => 'Data Mahasiswa',
            'data' => $data_mahasiswa
        ];
        echo view('vw_excel_mahasiswa', $data);
    }
   
 
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
 		//echo '<pre>';  var_dump($_FILES['file']['name']); echo '</pre>';
        $config['upload_path'] = './uploads/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = '10000';
 
 
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('file')){
        	$error = array('error' => $this->upload->display_errors());
        }
        else{
        	$data = array('Upload File Excel' => $this->upload->data());
        	
        }
        //redirect('mahasiswa','refresh');
        $media = $this->upload->data('file');
        //echo '<pre>';  var_dump($config); echo '</pre>';
        $inputFileName = './uploads/'.$config['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database   

                $excel_timestamp = $rowData[0][7]-1;
				$php_timestamp = mktime(0,0,0,1,$excel_timestamp,1900);
				$mysql_timestamp = date('Y-m-d', $php_timestamp);

                 $save_data = array(
                    "nim"=> $rowData[0][1],
                    "nama"=> $rowData[0][2],
                    "asal_sma"=> $rowData[0][3],
                    "jalur_masuk"=> $rowData[0][4],
                    "tahun_masuk"=> $rowData[0][5],
                    "tempat_lahir"=> $rowData[0][6],
                    "tanggal_lahir"=> $mysql_timestamp,
                );
                //sesuaikan nama dengan nama tabel
                $insert = $this->mahasiswaModel->updateexcel($save_data);
                //delete_files($media['file_path']);
                     
            }
        redirect('mahasiswa','refresh');
    

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
            for ($p=0; $p < $highestSheet; $p++) {

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database   

                $excel_timestamp = $rowData[0][7]-1;
				$php_timestamp = mktime(0,0,0,1,$excel_timestamp,1900);
				$mysql_timestamp = date('Y-m-d', $php_timestamp);

                 $save_data = array(
                    "nim"=> $rowData[0][1],
                    "nama"=> $rowData[0][2],
                    "asal_sma"=> $rowData[0][3],
                    "jalur_masuk"=> $rowData[0][4],
                    "tahun_masuk"=> $rowData[0][5],
                    "tempat_lahir"=> $rowData[0][6],
                    "tanggal_lahir"=> $mysql_timestamp,
                );

                

                //sesuaikan nama dengan nama tabel
                $insert = $this->mahasiswaModel->updateexcel($save_data);
                //delete_files($media['file_path']);
                $cek_id = $this->mahasiswaModel->cekusermahasiswa($rowData[0][1]);
                echo '<pre>';  var_dump($cek_id); echo '</pre>';

                if (empty($cek_id)) {

                    $save_data_user = [
                      'id' => $rowData[0][1],
                      'username' => $rowData[0][1],
                      'email' => '',
                      'password' => password_hash('admin', PASSWORD_DEFAULT),
                      'level' => 2,
                    ];

                    $insert = $this->mahasiswaModel->updateusermahasiswa($save_data_user);
                }
            }
           }

        } else {
            //echo $_FILES['upload_file']['type'];
            echo '<pre>';  var_dump($_FILES['file']['type']); echo '</pre>';

        }
        //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
        $arr['breadcrumbs'] = 'relevansi_ppm';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan4';
       //$this->load->view('vw_template', $arr);


    }

    public function resetPassword() {
        $data['breadcrumbs'] = 'mahasiswa';
        $data['content'] = 'mahasiswa/reset_password';
        echo view('vw_template', $data);
    }

    public function submitResetPassword() {
        $request = \Config\Services::request();

        if ($request->getPost('simpan')) {
            $save_data = [
                'password' => password_hash('admin', PASSWORD_DEFAULT),
            ];
            $id_edit = $request->getPost('NIM');
            $this->mahasiswaModel->submitResetPasswordMahasiswa($save_data, $id_edit);
            return redirect()->to('/mahasiswa');
        }

        $data['breadcrumbs'] = 'mahasiswa';
        $data['content'] = 'mahasiswa/reset_password';
        echo view('vw_template', $data);
    }

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set title
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Data Mahasiswa');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'NIM');
        $sheet->setCellValue('B2', 'Nama');
        $sheet->setCellValue('C2', 'Tahun Angkatan');
        $sheet->setCellValue('D2', 'Kurikulum');
        $sheet->setCellValue('E2', 'Status');

        $sheet->getStyle('A2:E2')->getFont()->setBold(true);

        // Add borders to cells
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        // Apply border style to the header row and a few more rows for template
        $sheet->getStyle('A1:E30')->applyFromArray($styleArray);

        // Set the column width to auto size
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new WriterXlsx($spreadsheet);

        $filename = 'template_mahasiswa.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function uploadExcel()
    {
        // Mengambil file yang diunggah dari request
        $file = $this->request->getFile('excel_file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            // Membaca file Excel yang diunggah
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $data = [];
            
            // Mengambil data dari setiap baris
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                if ($rowIndex < 2) continue; // Skip header row (row 1 and 2)
                
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                $rowData = [];
                foreach ($cellIterator as $cell) {
                    $rowData[] = $cell->getValue();
                }
                $data[] = $rowData;
            }
            
            // Menghapus baris header
            array_shift($data);

            // Menghapus data yang kosong atau invalid
            $filteredData = array_filter($data, function($row) {
                return !empty($row[0]);
            });

            // Menyimpan data ke database
            $model = new \App\Models\MahasiswaModel();
            //dd($filteredData);
            foreach ($filteredData as $row) {
                $model->updateExcel([
                    'nim' => $row[0],
                    'nama' => $row[1],
                    'tahun_masuk' => $row[2],
                    'kode_kurikulum' => $row[3],
                    'StatusAkademik' => $row[4],
                ]);

                $model->updateUserMahasiswa([
                    'id' => $row[0],
                    'username' => $row[0],
                    'email' => '',
                    'password' => password_hash($row[0], PASSWORD_DEFAULT),
                    'level' => 2,
                ]);
            }
            session()->setFlashdata('success', 'Data berhasil disimpan!');
            return redirect()->to('/mahasiswa');
        }
        session()->setFlashdata('error', 'Data gagal disimpan!');
        return redirect()->to('/mahasiswa');
    }
}



 