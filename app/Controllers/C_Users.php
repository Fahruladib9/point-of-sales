<?php

namespace App\Controllers;

use App\Models\M_Users;
use App\Controllers\Settings;

class C_Users extends BaseController
{
    public function __construct()
    {
        $this->users = new M_Users();
        $this->settings = new Settings();
    }

    public function index()
    {
        $data['users'] = $this->users->showData();
        return view('users/users', $data);
    }

    public function tambah()
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username harus diisi',
                ],
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password harus diisi',
                ],
            ],
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $this->users->insert([
                'username' => $data['username'],
                'password' => $data['password'],
                'nama' => $data['nama'],
                'akses' => 'kasir',
            ]);
            $this->settings->allert('Sukses', 'Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data['users'] = $this->users->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username harus diisi',
                ],
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password harus diisi',
                ],
            ],
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            session()->getFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $this->users->update($id, [
                'username' => $data['username'],
                'password' => $data['password'],
                'nama' => $data['nama'],
                'akses' => 'kasir',
            ]);
            $this->settings->allert('Sukses', 'Data berhasil diperbarui', 'success');
            return redirect()->to('users');
        }
    }

    public function delete($id)
    {
        $this->users->delete($id);
        $this->settings->allert('Sukses', 'Data berhasil diperbarui', 'success');
        return redirect()->back();
    }
}
