<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Dosen extends Controller {

	public function __construct()
  	{
  		$this->dosen_model = new \App\Models\DosenModel();
  		$this->user_model = new \App\Models\UserModel();
    	
    	if (session()->get('loggedin') != true || session()->get('level') != 0) {
      		header('Location: ' . base_url('Auth/login'));
            exit(); 
    	}
  	}
 
	public function index()
	{ 
		$data['breadcrumbs'] = 'dosen'; 
		$data['content'] = 'vw_dosen';
		$data['datas'] =  $this->dosen_model->getdosen();
		
		return view('vw_template', $data); 
	}
 
	public function tambah()
	{
		$data['breadcrumbs'] = 'dosen'; 
		$data['content'] = 'dosen/tambah';
		
		return view('vw_template', $data);
	}

	public function submit_tambah()
	{ 
		if ($this->request->getPost('simpan')) {
			$nip = $this->request->getPost('nip');
			$nama_dosen = $this->request->getPost('nama_dosen');
			
			if (!empty($nip) && !empty($nama_dosen)) {
				$KL = [
					'NIP' => $nip,
					'nama_dosen' => $nama_dosen,
					'password' => "123456",
				];

				$data_user_dosen = [
					'id' => $nip,
                    'username' => $nip,
                    'email' => '',
                    'password' => password_hash($nip, PASSWORD_DEFAULT),
                    'level' => 1,
				];
				
				//dd($saveData);
				$query = $this->dosen_model->updateDosen($KL);
				$query = $this->dosen_model->updateUserDosen($data_user_dosen); 

				//dd($query);
				session()->setFlashdata('success', 'Data berhasil disimpan!');
                return redirect()->to('dosen');
			} else {
				// Handle case where required fields are empty
				// You can add a flash message or redirect with an error
				session()->setFlashdata('error', 'Data gagal disimpan!');
                return redirect()->to('dosen');
			}
		} 
	}

	public function export_excel()
	{
		$data_dosen = $this->dosen_model->getdosen();
        $data = [
            'title' => 'Data dosen',
            'data' => $data_dosen
        ];

        return view('vw_excel_dosen', $data);
    } 

	public function suksesSimpan()
    {
        $arr['breadcrumbs'] = 'dosen';
        $arr['content'] = 'vw_data_berhasil_disimpan';

        echo view('vw_template', $arr);
    }
}
