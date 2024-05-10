<?php

namespace App\Controllers;

use App\Models\M_Users;

class C_Auth extends BaseController
{

    public function __construct()
    {
        $this->user = new M_Users();
    }

    public function index()
    {
        return view('login');
    }

    public function prosesLogin()
    {
        $data = esc($this->request->getPost());
        $getUser = $this->user->where('username', $data['username'])->first();

        if ($getUser && $getUser->password == $data['password']) {
            $data = [
                'id_users' => $getUser->id_users,
                'username' => $getUser->username,
                'password' => $getUser->password,
                'nama' => $getUser->nama,
                'akses' => $getUser->akses,
            ];

            session()->set('user', $data);

            if ($getUser->akses == 'admin') {
                return redirect()->to('/');
            }
            if ($getUser->akses == 'kasir') {
                return redirect()->to('/kasir');
            }
        } else {
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
