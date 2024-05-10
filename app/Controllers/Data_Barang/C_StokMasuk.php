<?php

namespace App\Controllers\Data_Barang;

use App\Controllers\BaseController;
use App\Controllers\Settings;
use App\Models\M_Product;
use App\Models\M_StokMasuk;
use App\Models\M_Suplier;
use stdClass;

class C_StokMasuk extends BaseController
{

    public function __construct()
    {
        $this->setting = new Settings();
        $this->stokMasuk = new M_StokMasuk();
        $this->suplier = new M_Suplier();
        $this->product = new M_Product();
    }

    public function index()
    {
        $data['product'] = $this->product->findAll();
        $data['stok_masuk'] = $this->stokMasuk->showData();
        $data['kode_transaksi'] = $this->kode_transaksi()->newKode;
        $data['suplier'] = $this->suplier->findAll();
        return view('stok_masuk/stok_masuk', $data);
    }

    public function kode_transaksi()
    {
        $kodeTerakhir = $this->stokMasuk->select('kode_transaksi')->orderBy('id_stokMasuk', 'DESC')->first();
        $kodeTransaksi = 'TM' . substr(date('Y'), -2) . date('m') . date('d') . '001';
        $data = new stdClass();
        if ($kodeTerakhir) {
            $kodeTerakhir = $kodeTerakhir->kode_transaksi;
            $lastThreeDigits = substr($kodeTerakhir, -3);
            $newKode =  'TM' . substr(date('Y'), -2) . date('m') . date('d') . str_pad((int)$lastThreeDigits + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newKode = $kodeTransaksi;
        }
        $data->newKode = $newKode;
        return $data;
    }

    public function tambah()
    {
        $data = esc($this->request->getPost());
        $product = $this->product->where('nama_product', $data['nama_product'])->first();

        if (!$this->validate([
            'kode_transaksi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kode transaksi harus diisi',
                ],
            ],
            'nama_product' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama produk harus diisi',
                ],
            ],
            'jumlah' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah harus diisi',
                    'numeric' => 'Jumlah hanya boleh diisi angka',
                ],
            ],
            'suplier' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Suplier harus diisi',
                ],
            ],
            'tanggal' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi',
                ],
            ],
        ])) {
            session()->getFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        } else {
            $this->stokMasuk->insert([
                'id_product' => $product->id_product,
                'kode_transaksi' => $data['kode_transaksi'],
                'nama_product' => $data['nama_product'],
                'jumlah' => $data['jumlah'],
                'suplier' => $data['suplier'],
                'tanggal' => $data['tanggal'],
            ]);
            $this->product->update($product->id_product, [
                'jumlah' => $product->jumlah += $data['jumlah'],
            ]);
            $this->setting->allert('Sukses', 'Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $this->stokMasuk->delete($id);
        $this->setting->allert('Sukses', 'Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
