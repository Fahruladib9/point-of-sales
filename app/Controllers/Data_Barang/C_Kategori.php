<?php

namespace App\Controllers\Data_Barang;

use App\Controllers\BaseController;
use App\Controllers\Settings;
use App\Models\M_Kategori;

class C_Kategori extends BaseController
{

    public function __construct()
    {
        $this->setting = new Settings();
        $this->kategori = new M_Kategori();
    }

    public function index()
    {
        $data['kategori'] = $this->kategori->showData();
        return view('kategori/kategori', $data);
    }

    public function tambah()
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'kategori' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                ],
            ],
        ])) {
            $listError = $this->validator->listErrors();
            session()->setFlashdata('error', $listError);
            return redirect()->back();
        } else {
            $this->kategori->tambah($data);
            $this->setting->allert('Sukses', 'Data Berhasil Ditambahkan', 'success');
            return redirect()->to('/kategori');
        }
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategori->find($id);
        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'kategori' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                ],
            ],
        ])) {
            $listError = $this->validator->listErrors();
            session()->setFlashdata('error', $listError);
            return redirect()->back();
        } else {
            $this->kategori->update($id, $data);
            $this->setting->allert('Sukses', 'Data Berhasil Diupdate', 'success');
            return redirect()->to('/kategori');
        }
    }

    public function delete($id)
    {
        $this->kategori->delete($id);
        $this->setting->allert('Sukses', 'Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }
}
