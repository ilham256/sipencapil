<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user';
	protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'email', 'level', 'last_login'];
    const SESSION_KEY = 'id';

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|max_length[255]'
        ];
    }

    public function login($username, $password)
    {
        // Pastikan username diubah menjadi string
        $username = (string)$username;

        $user = $this->where('email', $username)
                     ->orWhere('username', $username)
                     ->first();

        if (!$user) {
            return false;
        }

        // Pastikan password diubah menjadi string
        $password = (string)$password;

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        session()->set(self::SESSION_KEY, $user['id']);
        session()->set('nama_user', $username);
        session()->set('level', $user['level']);
        $this->_update_last_login($user['id']);

        return session()->has(self::SESSION_KEY);
    }

    public function current_user()
    {
        if (!session()->has(self::SESSION_KEY)) {
            return null;
        }

        return $this->find(session()->get(self::SESSION_KEY));
    }

    public function logout()
    {
        session()->remove(self::SESSION_KEY);
        return !session()->has(self::SESSION_KEY);
    }

    private function _update_last_login($id)
    {
        $this->update($id, ['last_login' => date("Y-m-d H:i:s")]);
    }
}

