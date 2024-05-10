<?php

namespace App\Controllers\Data_Barang;

use App\Controllers\BaseController;
use App\Controllers\Settings;
use App\Models\M_Suplier;

class C_Suplier extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        $this->suplier = new M_Suplier();
    }

    public function index()
    {
        $data['suplier'] = $this->suplier->showData();
        return view('suplier/suplier', $data);
    }

    public function tambah()
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'suplier' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Suplier harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $this->suplier->tambah($data);
            $this->settings->allert('Sukses', 'Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data['suplier'] = $this->suplier->find($id);
        return view('suplier/edit', $data);
    }

    public function update($id)
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'suplier' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Suplier harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $this->suplier->update($id, $data);
            $this->settings->allert('Sukses', 'Data berhasil diperbarui', 'success');
            return redirect()->to('suplier');
        }
    }

    public function delete($id)
    {
        $this->suplier->delete($id);
        $this->settings->allert('Sukses', 'Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
