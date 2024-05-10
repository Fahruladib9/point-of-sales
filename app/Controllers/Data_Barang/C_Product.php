<?php

namespace App\Controllers\Data_Barang;

use App\Controllers\BaseController;
use App\Controllers\Settings;
use App\Models\M_Kategori;
use App\Models\M_Product;
use App\Models\M_Unit;
use stdClass;

class C_Product extends BaseController
{

    public function __construct()
    {
        $this->productModel = new M_Product();
        $this->kategori = new M_Kategori();
        $this->unit = new M_Unit();
        $this->settings = new Settings();
    }

    public function index()
    {
        $data['product'] = $this->productModel->orderBy('id_product', 'DESC')->findAll();
        $data['kategori'] = $this->kategori->findAll();
        $data['unit'] = $this->unit->showData();
        $data['kode_product'] = $this->kodeBarang()->newKode;
        // menjumlahkan jumlah dari nama product yang sama
        // $data['product'] = $this->productModel->select('nama_product')->groupBy('nama_product')->selectSum('jumlah')->findAll();
        // dd($data);
        return view('product/product', $data);
    }

    public function kodeBarang()
    {
        $lastKode = $this->productModel->lastKode();
        $data = new stdClass();
        $kodeBarang = 'BRG001';
        if ($lastKode) {
            $lastKode = $lastKode->kode_product;
            $lastThreeDigits = substr($lastKode, -3);
            $newKode = 'BRG' . str_pad((int)$lastThreeDigits + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newKode = $kodeBarang;
        }
        $data->newKode = $newKode;
        return $data;
    }

    public function tambah()
    {
        $data = esc($this->request->getPost());
        $cekNamaSama = $this->productModel->select('nama_product')->where('nama_product', $data['nama_product'])->first();
        $cekKodeSama = $this->productModel->select('kode_product')->where('kode_product', $data['kode_product'])->first();

        if (!$this->validate([
            'kode_product' => [
                'label'  => 'kode_product',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kode barang harus diisi',
                ],
            ],
            'nama_product' => [
                'label'  => 'nama_product',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi',
                ],
            ],
            'kategori' => [
                'label'  => 'kategori',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                ],
            ],
            'unit' => [
                'label'  => 'unit',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Unit harus diisi',
                ],
            ],
            'harga_beli' => [
                'label'  => 'harga_beli',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Harga beli harus diisi',
                    'numeric' => 'Harga beli hanya bisa mengandung angka',
                ],
            ],
            'harga_jual' => [
                'label'  => 'harga_jual',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Harga jual harus diisi',
                    'numeric' => 'Harga jual hanya bisa mengandung angka',
                ],
            ],
            'jumlah' => [
                'label'  => 'jumlah',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi',
                    'numeric' => 'Stok hanya bisa mengandung angka',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            if ($cekNamaSama || $cekKodeSama) {
                $this->settings->allert('Oops!', 'Nama produk atau kode produk sudah ada', 'error');
                return redirect()->back();
            } else {
                $this->productModel->insert($data);
                $this->settings->allert('Sukses', 'Data berhasil ditambahkan', 'success');
                return redirect()->to('product');
            }
        }
    }

    public function edit($id)
    {
        $data['product'] = $this->productModel->where('id_product', $id)->first();
        $data['kategori'] = $this->kategori->findAll();
        $data['unit'] = $this->unit->showData();
        return view('product/edit', $data);
    }

    public function update($id)
    {
        $data = esc($this->request->getPost());
        if (!$this->validate([
            'kode_product' => [
                'label'  => 'kode_product',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kode barang harus diisi',
                ],
            ],
            'nama_product' => [
                'label'  => 'nama_product',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi',
                ],
            ],
            'kategori' => [
                'label'  => 'kategori',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                ],
            ],
            'unit' => [
                'label'  => 'unit',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Unit harus diisi',
                ],
            ],
            'harga_beli' => [
                'label'  => 'harga_beli',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Harga beli harus diisi',
                    'numeric' => 'Harga beli hanya bisa mengandung angka',
                ],
            ],
            'harga_jual' => [
                'label'  => 'harga_jual',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Harga jual harus diisi',
                    'numeric' => 'Harga jual hanya bisa mengandung angka',
                ],
            ],
            'jumlah' => [
                'label'  => 'jumlah',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi',
                    'numeric' => 'Stok hanya bisa mengandung angka',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        $this->productModel->update($id, $data);
        $this->settings->allert('Sukses', 'Data berhasil diupdate', 'success');
        return redirect()->to('/product');
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        $this->settings->allert('Sukses', 'Data berhasil dihapus', 'success');
        return redirect()->to('/product');
    }
}
