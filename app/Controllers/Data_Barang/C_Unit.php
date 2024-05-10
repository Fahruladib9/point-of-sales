<?php

namespace App\Controllers\Data_Barang;

use App\Controllers\BaseController;
use App\Controllers\Settings;
use App\Models\M_Unit;

class C_Unit extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        $this->unit = new M_Unit();
    }

    public function index()
    {
        $data['unit'] = $this->unit->showData();
        return view('unit/unit', $data);
    }

    public function tambah()
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'unit' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Unit harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $this->unit->tambah($data);
            $this->settings->allert('Sukses', 'Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data['unit'] = $this->unit->find($id);
        return view('unit/edit', $data);
    }

    public function update($id)
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'unit' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Unit harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $this->unit->update($id, $data);
            $this->settings->allert('Sukses', 'Data berhasil diperbarui', 'success');
            return redirect()->to('unit');
        }
    }

    public function delete($id)
    {
        $this->unit->delete($id);
        $this->settings->allert('Sukses', 'Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
