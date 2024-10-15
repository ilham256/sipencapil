<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
	protected $userModel;

	public function __construct()
	{
		$this->userModel = new UserModel();

		if (!session()->get('loggedin') || session()->get('level') != 3) {
			header('Location: ' . base_url('Auth/login'));
            exit(); 
		}
	}

	// User Admin
	public function admin()
	{
		$data['breadcrumbs'] = 'Dashboard';
		$data['content'] = 'login_operator/vw_admin';
		$data['datas'] = $this->userModel->getAdmin();
		return view('vw_template_operator', $data);
	}

	public function tambah_admin()
	{
		$data['breadcrumbs'] = 'Dashboard';
		$data['content'] = 'login_operator/vw_tambah_admin';
		return view('vw_template_operator', $data);
	}

	public function submit_tambah_admin()
	{
		if ($this->request->getPost('simpan')) {
			$save_data = [
				'id' => $this->request->getPost('username'),
				'username' => $this->request->getPost('username'),
				'email' => $this->request->getPost('email'),
				'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
				'level' => 0,
			];
			$query = $this->userModel->submitTambahAdmin($save_data);
			if ($query) {
				session()->setFlashdata('success', 'Data berhasil disimpan!');
                return redirect()->to('/user/admin');
			}
		}
	}

	public function hapus_admin($id)
	{
		$hapus = $this->userModel->hapusUser($id);
		session()->setFlashdata('success', 'Data berhasil dihapus!');
        return redirect()->to('/user/admin');
	}

	// User dosen
	public function dosen()
	{
		$data['breadcrumbs'] = 'Dashboard';
		$data['content'] = 'login_operator/vw_dosen';
		$data['datas'] = $this->userModel->getDosen();
		return view('vw_template_operator', $data);
	}

	public function tambah_dosen()
	{
		$data['breadcrumbs'] = 'Dashboard';
		$data['content'] = 'login_operator/vw_tambah_dosen';
		return view('vw_template_operator', $data);
	}

	public function submit_tambah_dosen()
	{
		if ($this->request->getPost('simpan')) {
			$save_data = [
				'id' => $this->request->getPost('username'),
				'username' => $this->request->getPost('username'),
				'email' => $this->request->getPost('email'),
				'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
				'level' => 1,
			];
			$query = $this->userModel->submitTambahDosen($save_data);
			if ($query) {
				session()->setFlashdata('success', 'Data berhasil disimpan!');
                return redirect()->to('/user/dosen');
			}
		}
	}

	public function hapus_dosen($id)
	{
		$hapus = $this->userModel->hapusUser($id);
		session()->setFlashdata('success', 'Data berhasil dihapus!');
        return redirect()->to('/user/dosen');
	}

	// User mahasiswa
	public function mahasiswa()
	{
		$data['breadcrumbs'] = 'Dashboard';
		$data['content'] = 'login_operator/vw_mahasiswa';
		$data['datas'] = $this->userModel->getMahasiswa();
		return view('vw_template_operator', $data);
	}

	public function tambah_mahasiswa()
	{
		$data['breadcrumbs'] = 'Dashboard';
		$data['content'] = 'login_operator/vw_tambah_mahasiswa';
		return view('vw_template_operator', $data);
	}

	public function submit_tambah_mahasiswa()
	{
		if ($this->request->getPost('simpan')) {
			$save_data = [
				'id' => $this->request->getPost('username'),
				'username' => $this->request->getPost('username'),
				'email' => $this->request->getPost('email'),
				'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
				'level' => 2,
			];
			$query = $this->userModel->submitTambahMahasiswa($save_data);
			if ($query) {
				session()->setFlashdata('success', 'Data berhasil disimpan!');
                return redirect()->to('/user/mahasiswa');
			}
		}
	}

	public function hapus_mahasiswa($id)
	{
		$hapus = $this->userModel->hapusUser($id);
		session()->setFlashdata('success', 'Data berhasil dihapus!');
        return redirect()->to('/user/mahasiswa');
	}

	public function reset()
	{
		$data['breadcrumbs'] = 'Dashboard';
		$data['content'] = 'login_operator/vw_reset';
		return view('vw_template_operator', $data);
	}

	public function submit_reset()
	{
		if ($this->request->getPost('simpan')) {
			$save_data = [
				'id' => $this->request->getPost('username'),
				'username' => $this->request->getPost('username'),
				'password' => password_hash($this->request->getPost('username'), PASSWORD_DEFAULT),
			];
			$query = $this->userModel->submitReset($save_data);
			if ($query) {
				session()->setFlashdata('success', 'Password berhasil direset!');
                return redirect()->to('/user/reset');
			}
		}
	}
}
