<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Controller;
use CodeIgniter\Validation\ValidationInterface;
use CodeIgniter\Session\SessionInterface;

class Auth extends Controller
{
    protected SessionInterface $session;
    protected AuthModel $authModel;
    protected ValidationInterface $validation;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->authModel = new AuthModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function login()
    {
        if ($this->session->get('loggedin')) {
            return $this->redirectUserByLevel();
        }

        $rules = $this->authModel->rules();
        $this->validation->setRules($rules);

        if (!$this->validate($rules)) {
            return view('login_form', ['validation' => $this->validation]);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($this->authModel->login($username, $password)) {
            $this->session->set('loggedin', true);
            return $this->redirectUserByLevel();
        }

        $this->session->setFlashdata('message_login_error', 'Login Gagal, pastikan username dan password benar!');
        return view('login_form', ['keterangan' => 0]);
    }

    public function logout()
    {
        $this->session->destroy();
        $this->authModel->logout();
        return redirect()->to('Auth/login');
    }

    private function redirectUserByLevel()
    {
        switch ($this->session->get('level')) {
            case 1:
                return redirect()->to('DashboardDosen');
            case 2:
                return redirect()->to('DashboardMahasiswa');
            case 3:
                return redirect()->to('DashboardOperator');
            case 4:
                return redirect()->to('DashboardGuest');
            default:
                return redirect()->to('Dashboard');
        }
    }
}
